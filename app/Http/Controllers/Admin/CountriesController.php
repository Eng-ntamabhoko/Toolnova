<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolUsageLog;
use Illuminate\Support\Facades\DB;

class CountriesController extends Controller
{
    public function __invoke()
    {
        // Stats section
        $totalCountriesTracked = ToolUsageLog::whereNotNull('country')
            ->distinct('country')
            ->count('country');

        $totalCountryTaggedVisits = ToolUsageLog::whereNotNull('country')->count();
        $nullCountryVisits = ToolUsageLog::whereNull('country')->count();

        // Top countries section
        $topCountries = ToolUsageLog::whereNotNull('country')
            ->select('country', DB::raw('COUNT(*) as total'))
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(20)
            ->get()
            ->map(function ($country) use ($totalCountryTaggedVisits) {
                $country->percentage = $totalCountryTaggedVisits > 0 
                    ? round(($country->total / $totalCountryTaggedVisits) * 100, 2)
                    : 0;
                return $country;
            });

        // Recent activity section
        $recentActivity = ToolUsageLog::with([
                'user:id,name',
                'tool:id,name',
            ])
            ->select(['id', 'country', 'tool_id', 'tool_slug', 'user_id', 'action_type', 'ip_address', 'browser', 'created_at'])
            ->orderByDesc('created_at')
            ->limit(30)
            ->get()
            ->map(function ($log) {
                $log->tool_name = $log->tool?->name ?? ucwords(str_replace('-', ' ', $log->tool_slug ?? 'Unknown'));
                $log->user_display = $log->user?->name ?? 'Guest';
                return $log;
            });

        return view('admin.countries', compact(
            'totalCountriesTracked',
            'totalCountryTaggedVisits',
            'nullCountryVisits',
            'topCountries',
            'recentActivity'
        ));
    }
}
