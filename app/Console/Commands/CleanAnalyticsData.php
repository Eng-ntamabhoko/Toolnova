<?php

namespace App\Console\Commands;

use App\Models\ToolUsageLog;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanAnalyticsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics:clean {days=30}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old rows from tool_usage_logs older than the specified number of days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->argument('days');
        $cutoff = now()->subDays($days);

        $count = ToolUsageLog::where('created_at', '<', $cutoff)->count();

        if ($count > 0) {
            ToolUsageLog::where('created_at', '<', $cutoff)->delete();
            $this->info("Cutoff date: {$cutoff->toDateTimeString()}");
            $this->info("Deleted {$count} rows from tool_usage_logs");
        } else {
            $this->info("Cutoff date: {$cutoff->toDateTimeString()}");
            $this->info("No rows to delete from tool_usage_logs");
        }

        return Command::SUCCESS;
    }
}
