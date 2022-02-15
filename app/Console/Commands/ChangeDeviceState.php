<?php

namespace App\Console\Commands;

use App\Models\DeviceState;
use Illuminate\Console\Command;

class ChangeDeviceState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devices:changeState';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change Device state on opposite value';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach (DeviceState::all() as $deviceState) {
            $deviceState->update(['state' => !$deviceState->state]);
        }
    }
}
