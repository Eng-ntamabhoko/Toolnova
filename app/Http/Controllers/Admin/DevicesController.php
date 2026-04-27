<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ToolUsageLog;
use Illuminate\Support\Facades\DB;

class DevicesController extends Controller
{
    public function __invoke()
    {
        // Stats section
        $totalDeviceTaggedVisits = ToolUsageLog::whereNotNull('device')->where('device', '!=', '')->count();
        $uniqueDeviceTypes = ToolUsageLog::whereNotNull('device')->where('device', '!=', '')->distinct('device')->count('device');
        $browserFamiliesTracked = ToolUsageLog::whereNotNull('browser')->where('browser', '!=', '')->distinct('browser')->count('browser');
        $operatingSystemsTracked = ToolUsageLog::whereNotNull('os')->where('os', '!=', '')->distinct('os')->count('os');

        // Top devices section
        $topDevices = ToolUsageLog::whereNotNull('device')
            ->where('device', '!=', '')
            ->select('device', DB::raw('COUNT(*) as total'))
            ->groupBy('device')
            ->orderByDesc('total')
            ->limit(20)
            ->get()
            ->map(function ($device) use ($totalDeviceTaggedVisits) {
                $device->percentage = $totalDeviceTaggedVisits > 0 
                    ? round(($device->total / $totalDeviceTaggedVisits) * 100, 2)
                    : 0;
                return $device;
            });

        // Browser distribution
        $totalBrowserVisits = ToolUsageLog::whereNotNull('browser')
            ->where('browser', '!=', '')
            ->count();

        $browserDistribution = ToolUsageLog::whereNotNull('browser')
            ->where('browser', '!=', '')
            ->select('browser', DB::raw('COUNT(*) as total'))
            ->groupBy('browser')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->map(function ($browser) use ($totalBrowserVisits) {
                $browser->percentage = $totalBrowserVisits > 0 
                    ? round(($browser->total / $totalBrowserVisits) * 100, 2)
                    : 0;
                return $browser;
            });

        // OS distribution
        $totalOsVisits = ToolUsageLog::whereNotNull('os')
            ->where('os', '!=', '')
            ->count();

        $osDistribution = ToolUsageLog::whereNotNull('os')
            ->where('os', '!=', '')
            ->select('os', DB::raw('COUNT(*) as total'))
            ->groupBy('os')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->map(function ($os) use ($totalOsVisits) {
                $os->percentage = $totalOsVisits > 0 
                    ? round(($os->total / $totalOsVisits) * 100, 2)
                    : 0;
                return $os;
            });

        // Recent device activity
        $recentActivity = ToolUsageLog::with([
                'user:id,name',
                'tool:id,name',
            ])
            ->select(['id', 'device', 'browser', 'os', 'tool_id', 'tool_slug', 'user_id', 'action_type', 'ip_address', 'created_at'])
            ->orderByDesc('created_at')
            ->limit(30)
            ->get()
            ->map(function ($log) {
                $log->tool_name = $log->tool?->name ?? ucwords(str_replace('-', ' ', $log->tool_slug ?? 'Unknown'));
                $log->user_display = $log->user?->name ?? 'Guest';
                return $log;
            });

        return view('admin.devices', compact(
            'totalDeviceTaggedVisits',
            'uniqueDeviceTypes',
            'browserFamiliesTracked',
            'operatingSystemsTracked',
            'topDevices',
            'browserDistribution',
            'osDistribution',
            'recentActivity'
        ));
    }
}
