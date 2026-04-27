@extends('layouts.admin')

@section('title', 'Admin Overview')
@section('admin_subtitle', 'Traffic, visitors, tools, and platform activity at a glance')

@section('content')
<div class="space-y-8">
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Visitors Today</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($visitorsToday) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Visitors This Week</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($visitorsThisWeek) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Registered Users</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($totalUsers) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Guest Visitors</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($guestVisitors) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Logged Visitors</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($loggedVisitors) }}</p>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Top Tools</h2>
                <p class="mt-1 text-sm text-slate-500">Most active tools by usage.</p>
            </div>

            <div class="max-h-96 overflow-y-auto p-4">
                <div class="space-y-3">
                    @forelse($topTools as $tool)
                        <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                            <span class="font-medium text-slate-700">{{ $tool->tool_name }}</span>
                            <span class="text-sm font-semibold text-slate-900">{{ number_format($tool->total) }}</span>
                        </div>
                    @empty
                        <p class="px-2 text-sm text-slate-500">No tool data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Top Countries</h2>
                <p class="mt-1 text-sm text-slate-500">Visitor origin summary based on tracked traffic.</p>
            </div>

            <div class="max-h-96 overflow-y-auto p-4">
                <div class="space-y-3">
                    @forelse($topCountries as $country)
                        <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                            <span class="font-medium text-slate-700">{{ $country->country }}</span>
                            <span class="text-sm font-semibold text-slate-900">{{ number_format($country->total) }}</span>
                        </div>
                    @empty
                        <p class="px-2 text-sm text-slate-500">No country data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Top Referrers</h2>
                <p class="mt-1 text-sm text-slate-500">Where your visitors are coming from.</p>
            </div>

            <div class="max-h-96 overflow-y-auto p-4">
                <div class="space-y-3">
                    @forelse($topReferrers as $referrer)
                        <div class="flex items-center justify-between gap-4 rounded-2xl bg-slate-50 px-4 py-3">
                            <span class="truncate font-medium text-slate-700">{{ $referrer->referrer }}</span>
                            <span class="shrink-0 text-sm font-semibold text-slate-900">{{ number_format($referrer->total) }}</span>
                        </div>
                    @empty
                        <p class="px-2 text-sm text-slate-500">No referrer data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Devices</h2>
                <p class="mt-1 text-sm text-slate-500">Breakdown by desktop, mobile, and tablet traffic.</p>
            </div>

            <div class="max-h-96 overflow-y-auto p-4">
                <div class="space-y-3">
                    @forelse($devices as $device)
                        <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                            <span class="font-medium text-slate-700">{{ $device->device ?: 'Unknown' }}</span>
                            <span class="text-sm font-semibold text-slate-900">{{ number_format($device->total) }}</span>
                        </div>
                    @empty
                        <p class="px-2 text-sm text-slate-500">No device data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Browsers</h2>
                <p class="mt-1 text-sm text-slate-500">Most common browsers used by visitors.</p>
            </div>

            <div class="max-h-96 overflow-y-auto p-4">
                <div class="space-y-3">
                    @forelse($browsers as $browser)
                        <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                            <span class="font-medium text-slate-700">{{ $browser->browser ?: 'Unknown' }}</span>
                            <span class="text-sm font-semibold text-slate-900">{{ number_format($browser->total) }}</span>
                        </div>
                    @empty
                        <p class="px-2 text-sm text-slate-500">No browser data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Recent Activity</h2>
                <p class="mt-1 text-sm text-slate-500">Latest events captured across the platform.</p>
            </div>

            <div class="max-h-96 overflow-y-auto p-4">
                <div class="space-y-3">
                    @forelse($recentActivity as $activity)
                        <div class="rounded-2xl bg-slate-50 px-4 py-3">
                            <p class="text-sm font-semibold text-slate-900">
                                {{ $activity->action_type }}
                                @php
                                    $toolLabel = optional($activity->tool)->name
                                        ?? ($activity->tool_slug ? \Illuminate\Support\Str::of($activity->tool_slug)->replace('-', ' ')->title() : null);
                                @endphp
                                {{ $toolLabel ? ' · ' . $toolLabel : '' }}
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                {{ $activity->device }} · {{ $activity->browser }} · {{ $activity->country ?: 'Unknown country' }}
                            </p>
                            <p class="mt-1 text-xs text-slate-400">
                                {{ $activity->created_at }}
                            </p>
                        </div>
                    @empty
                        <p class="px-2 text-sm text-slate-500">No recent activity yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
@endsection