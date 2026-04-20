<?php

namespace App\Console\Commands;

use App\Models\DailyToolStat;
use App\Models\Tool;
use App\Models\ToolUsageLog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AggregateDailyToolStats extends Command
{
    protected $signature = 'analytics:aggregate-daily {date?}';
    protected $description = 'Aggregate daily tool usage stats';

    public function handle(): int
    {
        $date = $this->argument('date')
            ? Carbon::parse($this->argument('date'))->toDateString()
            : Carbon::yesterday()->toDateString();

        $rows = ToolUsageLog::select(
                'tool_slug',
                DB::raw('COUNT(*) as actions'),
                DB::raw("SUM(CASE WHEN action_type = 'page_view' THEN 1 ELSE 0 END) as visits"),
                DB::raw('COUNT(DISTINCT session_id) as unique_visitors')
            )
            ->whereDate('created_at', $date)
            ->whereNotNull('tool_slug')
            ->groupBy('tool_slug')
            ->get();

        foreach ($rows as $row) {
            $toolId = Tool::where('slug', $row->tool_slug)->value('id');

            DailyToolStat::updateOrCreate(
                [
                    'tool_slug' => $row->tool_slug,
                    'date' => $date,
                ],
                [
                    'tool_id' => $toolId,
                    'tool_slug' => $row->tool_slug,
                    'visits' => $row->visits,
                    'unique_visitors' => $row->unique_visitors,
                    'actions' => $row->actions,
                ]
            );
        }

        $this->info("Daily analytics aggregated for {$date}");

        return self::SUCCESS;
    }
}