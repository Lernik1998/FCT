<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ResetUserActivityHours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:reset-activity-hours';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reinicia las horas de actividad de todos los usuarios al inicio de cada mes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $user->activity_hours = 0;
            $user->save();
        }
    }
}
