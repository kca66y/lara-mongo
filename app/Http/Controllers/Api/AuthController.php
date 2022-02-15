<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): Response
    {
        $data = $request->safe()->merge(['password' => bcrypt($request->get('password'))]);

        /** @var User $user */
        $user = User::query()->create($data->all());

        $token = $user->createToken('API Token')->accessToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, ResponseAlias::HTTP_OK);
    }

    public function login(LoginRequest $request): Response
    {

        if (!auth()->attempt($request->validated())) {
            return response(['message' => 'Incorrect login or password'], ResponseAlias::HTTP_UNAUTHORIZED);
        }

        /** @var User $user */
        $user = auth()->user();

        $token = $user->createToken('API Token')->accessToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, ResponseAlias::HTTP_OK);
    }
}
