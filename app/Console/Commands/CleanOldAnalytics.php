<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ToolUsageLog;
use Carbon\Carbon;

class CleanOldAnalytics extends Command
{
    protected $signature = 'analytics:clean';
    protected $description = 'Delete old analytics data (older than 30 days)';

    public function handle()
    {
        $date = Carbon::now()->subDays(30);

        $deleted = ToolUsageLog::where('created_at', '<', $date)->delete();

        $this->info("Deleted {$deleted} old records.");
    }
}