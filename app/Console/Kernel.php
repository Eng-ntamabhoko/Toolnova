<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // CLEAN OLD ANALYTICS DAILY
        $schedule->command('analytics:clean 30')->daily();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}