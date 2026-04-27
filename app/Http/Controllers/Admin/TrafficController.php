<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolUsageLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrafficController extends Controller
{
    public function __invoke()
    {
        $today = Carbon::today();
        $weekAgo = Carbon::now()->subDays(6)->startOfDay();

        $totalPageViews = ToolUsageLog::where('action_type', 'page_view')->count();
        $totalUniqueVisitors = ToolUsageLog::distinct('session_id')->count('session_id');

        $guestVisitors = ToolUsageLog::whereNull('user_id')->distinct('session_id')->count('session_id');
        $loggedVisitors = ToolUsageLog::whereNotNull('user_id')->distinct('session_id')->count('session_id');

        $visitorsByDay = ToolUsageLog::selectRaw('DATE(created_at) as day, COUNT(DISTINCT session_id) as total')
            ->where('created_at', '>=', $weekAgo)
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $topPages = ToolUsageLog::select('page_url', DB::raw('COUNT(*) as total'))
            ->whereNotNull('page_url')
            ->groupBy('page_url')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $topLandingPages = ToolUsageLog::select('landing_page', DB::raw('COUNT(*) as total'))
            ->whereNotNull('landing_page')
            ->groupBy('landing_page')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $recentTraffic = ToolUsageLog::with(['user'])
            ->latest()
            ->limit(20)
            ->get();

        return view('admin.traffic', compact(
            'totalPageViews',
            'totalUniqueVisitors',
            'guestVisitors',
            'loggedVisitors',
            'visitorsByDay',
            'topPages',
            'topLandingPages',
            'recentTraffic'
        ));
    }
}
