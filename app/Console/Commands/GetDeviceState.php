<?php

namespace App\Console\Commands;

use App\Models\DeviceState;
use Illuminate\Console\Command;

class GetDeviceState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devices:getState';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get devices state';

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
        $this->table(
            ['ID', 'State', 'Device ID'],
            DeviceState::query()->get(['device_id', 'state'])->toArray()
        );
    }
}
