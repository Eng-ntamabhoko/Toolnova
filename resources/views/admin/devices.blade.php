@extends('layouts.admin')

@section('title', 'Devices - ToolNova Admin')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Devices Analytics</h1>
            <p class="mt-2 text-slate-600">Device, browser, and operating system usage insights.</p>
        </div>

        <!-- Stat Cards -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
            @include('admin.partials.stat-card', [
                'label' => 'Device-Tagged Visits',
                'value' => number_format($totalDeviceTaggedVisits),
                'subLabel' => 'Total tracked visits'
            ])
            @include('admin.partials.stat-card', [
                'label' => 'Device Types',
                'value' => number_format($uniqueDeviceTypes),
                'subLabel' => 'Unique devices'
            ])
            @include('admin.partials.stat-card', [
                'label' => 'Browser Families',
                'value' => number_format($browserFamiliesTracked),
                'subLabel' => 'Tracked browsers'
            ])
            @include('admin.partials.stat-card', [
                'label' => 'Operating Systems',
                'value' => number_format($operatingSystemsTracked),
                'subLabel' => 'Tracked OS'
            ])
        </div>

        <!-- Top Devices Table -->
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm mb-6">
            <h2 class="text-xl font-bold text-slate-900">Top Devices</h2>
            <p class="mt-1 text-sm text-slate-500">Most used device types</p>
            
            <div class="mt-4 overflow-x-auto">
                <div class="max-h-[400px] overflow-y-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="sticky top-0 bg-white z-10">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Rank</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Device</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Visits</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Share</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($topDevices as $index => $device)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-700 font-medium">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                            📱 {{ ucfirst($device->device ?: 'unknown') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right text-sm font-semibold text-slate-900">{{ number_format($device->total) }}</td>
                                    <td class="px-4 py-3 text-right text-sm">
                                        <div class="flex items-center justify-end gap-2">
                                            <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-green-500 rounded-full" style="width: {{ $device->percentage }}%"></div>
                                            </div>
                                            <span class="font-medium text-slate-700 text-right min-w-10">{{ $device->percentage }}%</span>
                                            <span class="text-xs text-slate-500">{{ number_format($device->total) }} visits</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-500">No device data available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Browser Distribution -->
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm mb-6">
            <h2 class="text-xl font-bold text-slate-900">Browser Distribution</h2>
            <p class="mt-1 text-sm text-slate-500">Top browsers used</p>
            
            <div class="mt-4 overflow-x-auto">
                <div class="max-h-[400px] overflow-y-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="sticky top-0 bg-white z-10">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Rank</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Browser</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Visits</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Share</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($browserDistribution as $index => $browser)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-700 font-medium">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                            🌐 {{ $browser->browser ?: 'Unknown' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right text-sm font-semibold text-slate-900">{{ number_format($browser->total) }}</td>
                                    <td class="px-4 py-3 text-right text-sm">
                                        <div class="flex items-center justify-end gap-2">
                                            <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-blue-500 rounded-full" style="width: {{ $browser->percentage }}%"></div>
                                            </div>
                                            <span class="font-medium text-slate-700 text-right min-w-10">{{ $browser->percentage }}%</span>
                                            <span class="text-xs text-slate-500">{{ number_format($browser->total) }} visits</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-500">No browser data available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Operating System Distribution -->
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm mb-6">
            <h2 class="text-xl font-bold text-slate-900">Operating System Distribution</h2>
            <p class="mt-1 text-sm text-slate-500">Top operating systems used</p>
            
            <div class="mt-4 overflow-x-auto">
                <div class="max-h-[400px] overflow-y-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="sticky top-0 bg-white z-10">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Rank</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">OS</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Visits</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Share</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($osDistribution as $index => $os)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-sm text-slate-700 font-medium">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-50 text-purple-700">
                                            💻 {{ $os->os ?: 'Unknown' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right text-sm font-semibold text-slate-900">{{ number_format($os->total) }}</td>
                                    <td class="px-4 py-3 text-right text-sm">
                                        <div class="flex items-center justify-end gap-2">
                                            <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                                <div class="h-full bg-purple-500 rounded-full" style="width: {{ $os->percentage }}%"></div>
                                            </div>
                                            <span class="font-medium text-slate-700 text-right min-w-10">{{ $os->percentage }}%</span>
                                            <span class="text-xs text-slate-500">{{ number_format($os->total) }} visits</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-500">No OS data available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Recent Device Activity -->
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Recent Device Activity</h2>
            <p class="mt-1 text-sm text-slate-500">Latest tool usage by device</p>
            
            <div class="mt-4 overflow-y-auto max-h-[400px]">
                <div class="space-y-2">
                    @forelse($recentActivity as $activity)
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-3 py-2 hover:border-slate-200 hover:bg-slate-100 transition">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium {{ $activity->device ? 'bg-green-100 text-green-700' : 'bg-slate-200 text-slate-700' }}">
                                            {{ $activity->device ? '📱 ' . $activity->device : 'Unknown' }}
                                        </span>
                                        
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-700">
                                            🌐 {{ $activity->browser ?: 'Unknown' }}
                                        </span>
                                        
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-purple-100 text-purple-700">
                                            💻 {{ $activity->os ?: 'Unknown' }}
                                        </span>
                                        
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-orange-100 text-orange-700">
                                            {{ $activity->tool_name }}
                                        </span>
                                        
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-red-100 text-red-700 capitalize">
                                            {{ str_replace('_', ' ', $activity->action_type) }}
                                        </span>
                                    </div>
                                    
                                    <p class="mt-1 text-xs text-slate-600">
                                        <span class="font-medium">{{ $activity->user_display }}</span>
                                        {{ $activity->ip_address ? ' · ' . $activity->ip_address : '' }}
                                    </p>
                                </div>
                                
                                <div class="text-right">
                                    <p class="text-xs font-medium text-slate-700">
                                        {{ $activity->created_at->format('M d, H:i') }}
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <p class="text-sm text-slate-500">No recent activity yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
