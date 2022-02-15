<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Device\AddRequest;
use App\Http\Requests\Api\Device\State\SetRequest;
use App\Models\Device;
use App\Models\DeviceState;
use App\Models\User;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DeviceController extends Controller
{
    public function get(): Response
    {
        /** @var User $user */
        $user = auth()->user();

        $response = [
            'data' => $user->devices
        ];

        return response($response);

    }

    public function add(AddRequest $request): Response
    {
        $data = $request->validated();

        $device = Device::query()->create($data);

        /** @var User $user */
        $user = auth()->user();

        $user->devices()->attach($device);

        return response()->noContent(ResponseAlias::HTTP_CREATED);
    }

    public function getState(Device $device): Response
    {
        $state = $device->state;

        $response = [
            'date' => $state
        ];

        return response($response, ResponseAlias::HTTP_OK);
    }

    public function setState(Device $device, SetRequest $request): Response
    {
        $data = $request->validated();

        /** @var DeviceState $state */
        $state = $device->state()->firstOr(function () use ($data, $device) {
            $model = DeviceState::query()->create($data);
            $device->state()->save($model);
            return $model;
        });

        $state->wasRecentlyCreated || $state->update($data);

        return response()->noContent($state->wasRecentlyCreated ? ResponseAlias::HTTP_CREATED : ResponseAlias::HTTP_ACCEPTED);
    }
}
