<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolUsageLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReferrersController extends Controller
{
    public function __invoke()
    {
        $totalReferrerVisits = ToolUsageLog::whereNotNull('referrer')->where('referrer', '!=', '')->count();

        $uniqueReferrers = ToolUsageLog::whereNotNull('referrer')->where('referrer', '!=', '')->distinct('referrer')->count('referrer');

        $directCount = ToolUsageLog::where(function ($q) {
            $q->whereNull('referrer')->orWhere('referrer', '');
        })->count();

        $topReferrers = ToolUsageLog::whereNotNull('referrer')
            ->where('referrer', '!=', '')
            ->get(['referrer'])
            ->map(function ($item) {
                $host = parse_url($item->referrer, PHP_URL_HOST);
                return $host ? preg_replace('/^www\./', '', $host) : 'Direct';
            })
            ->countBy()
            ->sortDesc()
            ->take(20)
            ->map(function ($count, $source) use ($totalReferrerVisits) {
                return (object) [
                    'source' => $source,
                    'count' => $count,
                    'percentage' => $totalReferrerVisits > 0 ? ($count / $totalReferrerVisits) * 100 : 0,
                ];
            })
            ->values();

        $recentActivities = ToolUsageLog::with(['user:id,name', 'tool:id,name'])
            ->select(['id', 'referrer', 'tool_id', 'tool_slug', 'user_id', 'action_type', 'created_at'])
            ->whereNotNull('referrer')
            ->where('referrer', '!=', '')
            ->latest()
            ->paginate(30)
            ->through(function ($activity) {
                $activity->tool_name = $activity->tool->name ?? Str::title(str_replace('-', ' ', $activity->tool_slug ?? 'Unknown'));
                $activity->user_display = $activity->user->name ?? 'Guest';
                $host = parse_url($activity->referrer, PHP_URL_HOST);
                $activity->source = $host ? preg_replace('/^www\./', '', $host) : 'Direct';
                return $activity;
            });

        return view('admin.referrers', compact('totalReferrerVisits', 'uniqueReferrers', 'directCount', 'topReferrers', 'recentActivities'));
    }
}
