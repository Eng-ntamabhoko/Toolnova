<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolUsageLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OverviewController extends Controller
{
    public function __invoke()
    {
        $today = Carbon::today();
        $weekAgo = Carbon::now()->subDays(6)->startOfDay();

        $visitorsToday = ToolUsageLog::whereDate('created_at', $today)
            ->distinct('session_id')
            ->count('session_id');

        $visitorsThisWeek = ToolUsageLog::where('created_at', '>=', $weekAgo)
            ->distinct('session_id')
            ->count('session_id');

        $totalUsers = User::count();

        $guestVisitors = ToolUsageLog::whereNull('user_id')
            ->distinct('session_id')
            ->count('session_id');

        $loggedVisitors = ToolUsageLog::whereNotNull('user_id')
            ->distinct('session_id')
            ->count('session_id');

        $topTools = ToolUsageLog::query()
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

        $topCountries = ToolUsageLog::select('country', DB::raw('COUNT(*) as total'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $topReferrers = ToolUsageLog::select('referrer', DB::raw('COUNT(*) as total'))
            ->whereNotNull('referrer')
            ->groupBy('referrer')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $recentActivity = ToolUsageLog::with(['user', 'tool'])
            ->latest()
            ->limit(15)
            ->get();

        $visitorsByDay = ToolUsageLog::selectRaw('DATE(created_at) as day, COUNT(DISTINCT session_id) as total')
            ->where('created_at', '>=', $weekAgo)
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $devices = ToolUsageLog::select('device', DB::raw('COUNT(*) as total'))
            ->groupBy('device')
            ->orderByDesc('total')
            ->get();

        $browsers = ToolUsageLog::select('browser', DB::raw('COUNT(*) as total'))
            ->groupBy('browser')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return view('admin.overview', compact(
            'visitorsToday',
            'visitorsThisWeek',
            'totalUsers',
            'guestVisitors',
            'loggedVisitors',
            'topTools',
            'topCountries',
            'topReferrers',
            'recentActivity',
            'visitorsByDay',
            'devices',
            'browsers'
        ));
    }
}