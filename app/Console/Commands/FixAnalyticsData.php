<?php

namespace App\Console\Commands;

use App\Models\ToolUsageLog;
use Illuminate\Console\Command;

class FixAnalyticsData extends Command
{
    protected $signature = 'fix:analytics';
    protected $description = 'Normalize existing analytics data for referrer, device, browser, and os values.';

    public function handle(): int
    {
        $this->info('Fixing analytics data...');

        ToolUsageLog::whereIn('referrer', ['127.0.0.1', 'localhost'])
            ->update(['referrer' => null]);

        ToolUsageLog::whereNull('device')->update(['device' => 'Unknown']);
        ToolUsageLog::whereNull('browser')->update(['browser' => 'Unknown']);
        ToolUsageLog::whereNull('os')->update(['os' => 'Unknown']);

        $this->info('Analytics data fix complete.');

        return Command::SUCCESS;
    }
}
