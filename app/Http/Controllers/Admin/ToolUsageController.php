<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolUsageLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ToolUsageController extends Controller
{
    public function __invoke()
    {
        $today = Carbon::today();
        $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();

        $totalToolUses = ToolUsageLog::where('action_type', 'tool_use')->count();
        $totalPageViews = ToolUsageLog::where('action_type', 'page_view')->count();

        $topToolUses = ToolUsageLog::query()
            ->leftJoin('tools', 'tool_usage_logs.tool_id', '=', 'tools.id')
            ->selectRaw("
                COALESCE(MAX(tools.name), MAX(tool_usage_logs.tool_slug)) as tool_name,
                COUNT(*) as total
            ")
            ->where('tool_usage_logs.action_type', 'tool_use')
            ->whereNotNull('tool_usage_logs.tool_slug')
            ->groupBy('tool_usage_logs.tool_slug')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $topPageViews = ToolUsageLog::query()
            ->leftJoin('tools', 'tool_usage_logs.tool_id', '=', 'tools.id')
            ->selectRaw("
                COALESCE(MAX(tools.name), MAX(tool_usage_logs.tool_slug)) as tool_name,
                COUNT(*) as total
            ")
            ->where('tool_usage_logs.action_type', 'page_view')
            ->whereNotNull('tool_usage_logs.tool_slug')
            ->groupBy('tool_usage_logs.tool_slug')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $recentActivity = ToolUsageLog::with(['user', 'tool'])
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();

        $dailyTrends = ToolUsageLog::selectRaw('DATE(created_at) as date, COUNT(*) as uses')
            ->where('action_type', 'tool_use')
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $chartLabels = [];
        $chartUses = [];

        $cursor = $sevenDaysAgo->copy();
        while ($cursor->lte($today)) {
            $dateKey = $cursor->toDateString();
            $chartLabels[] = $cursor->format('M j');
            $chartUses[] = $dailyTrends->get($dateKey)->uses ?? 0;
            $cursor->addDay();
        }

        $mostUsedTool = $topToolUses->first();
        $mostViewedTool = $topPageViews->first();

        return view('admin.tool-usage', compact(
            'totalToolUses',
            'totalPageViews',
            'topToolUses',
            'topPageViews',
            'recentActivity',
            'chartLabels',
            'chartUses',
            'mostUsedTool',
            'mostViewedTool'
        ));
    }
}