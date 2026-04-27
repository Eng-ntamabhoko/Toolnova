<?php

namespace App\Console\Commands;

use App\Models\ToolUsageLog;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PruneOldAnalyticsLogs extends Command
{
    protected $signature = 'analytics:prune-old-logs {days=90}';
    protected $description = 'Delete old raw analytics logs from tool_usage_logs while keeping daily aggregates';

    public function handle(): int
    {
        $days = (int) $this->argument('days');
        $cutoff = Carbon::now()->subDays($days);

        $query = ToolUsageLog::where('created_at', '<', $cutoff);
        $count = (clone $query)->count();

        if ($count === 0) {
            $this->info("No analytics logs older than {$days} days were found.");
            return self::SUCCESS;
        }

        $query->delete();

        $this->info("Deleted {$count} analytics log rows older than {$days} days.");
        $this->line("Daily aggregated stats were preserved.");

        return self::SUCCESS;
    }
}