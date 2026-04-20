@extends('layouts.admin')

@section('title', 'Referrers - ToolNova Admin')

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Referrers Analytics</h1>
            <p class="mt-2 text-slate-600">Analyze external traffic sources and referral trends.</p>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Referrer-tagged Visits</dt>
                            <dd class="text-lg font-medium text-slate-900">{{ number_format($totalReferrerVisits) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Unique Referrers</dt>
                            <dd class="text-lg font-medium text-slate-900">{{ number_format($uniqueReferrers) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Top Referrer Visits</dt>
                            <dd class="text-lg font-medium text-slate-900">{{ $topReferrers->first()?->count ? number_format($topReferrers->first()->count) : 0 }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Direct/Unknown</dt>
                            <dd class="text-lg font-medium text-slate-900">{{ number_format($directCount) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Referrers -->
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm mb-6">
            <h2 class="text-xl font-bold text-slate-900">Top Referrers</h2>
            <p class="mt-2 text-sm text-slate-500">Grouped by domain only; individual referrer URLs appear in recent activity.</p>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Referrer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Visits</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Share</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($topReferrers as $referrer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $referrer->source }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ number_format($referrer->count) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    <div class="flex items-center">
                                        <div class="w-full bg-slate-200 rounded-full h-2 mr-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $referrer->percentage }}%"></div>
                                        </div>
                                        <span>{{ number_format($referrer->percentage, 1) }}%</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p class="px-6 py-4 text-sm text-slate-500">No referrer data yet.</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Recent Referrer Activity -->
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Recent Referrer Activity</h2>
            <div class="mt-4 overflow-x-auto max-h-96">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50 sticky top-0">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Referrer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tool</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Action</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Time</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse($recentActivities as $activity)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                    <div>
                                        <div class="font-semibold">{{ $activity->source }}</div>
                                        <div class="text-xs text-slate-500 truncate max-w-xs" title="{{ $activity->referrer }}">{{ $activity->referrer }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $activity->tool_name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ ucfirst(str_replace('_', ' ', $activity->action_type)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $activity->user_display }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    <time datetime="{{ $activity->created_at->toISOString() }}" title="{{ $activity->created_at->format('Y-m-d H:i:s') }}">{{ $activity->created_at->diffForHumans() }}</time>
                                </td>
                            </tr>
                        @empty
                            <p class="px-6 py-4 text-sm text-slate-500">No recent referrer activity.</p>
                        @endforelse
                    </tbody>
                </table>
                @if($recentActivities->hasPages())
                    <div class="mt-4 flex justify-center">
                        {{ $recentActivities->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection
