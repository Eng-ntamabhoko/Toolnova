@php use Illuminate\Support\Str; @endphp
@extends('layouts.admin')

@section('title', 'Traffic - ToolNova Admin')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Traffic Analytics</h1>
        <p class="mt-2 text-slate-600">Monitor the health of page views and visitor behavior.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @include('admin.partials.stat-card', ['label' => 'Page Views Total', 'value' => number_format($totalPageViews)])
        @include('admin.partials.stat-card', ['label' => 'Unique Visitors', 'value' => number_format($totalUniqueVisitors)])
        @include('admin.partials.stat-card', ['label' => 'Guest Unique Visitors', 'value' => number_format($guestVisitors)])
        @include('admin.partials.stat-card', ['label' => 'Logged Unique Visitors', 'value' => number_format($loggedVisitors)])
    </div>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900">Visitors by Day (last 7 days)</h2>
        <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-200">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Day</th>
                        <th class="px-4 py-2 text-right text-xs font-medium uppercase tracking-wider text-slate-500">Unique visitors</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($visitorsByDay as $entry)
                        <tr>
                            <td class="px-4 py-2 text-sm text-slate-700">{{ $entry->day }}</td>
                            <td class="px-4 py-2 text-right text-sm font-semibold text-slate-900">{{ number_format($entry->total) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="px-4 py-4 text-sm text-slate-500">No data available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Top Pages</h2>
            <div class="mt-4 space-y-2 max-h-96 overflow-y-auto pr-1">
                @forelse($topPages as $page)
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-2">
                        <span class="truncate font-medium text-slate-700">{{ Str::after($page->page_url, '/tools/') }}</span>
                        <span class="text-sm font-semibold text-slate-900">{{ number_format($page->total) }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No top page data yet.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Top Landing Pages</h2>
            <div class="mt-4 space-y-2 max-h-96 overflow-y-auto pr-1">
                @forelse($topLandingPages as $page)
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-2">
                        <span class="truncate font-medium text-slate-700">{{ $page->landing_page }}</span>
                        <span class="text-sm font-semibold text-slate-900">{{ number_format($page->total) }}</span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No top landing data yet.</p>
                @endforelse
            </div>
        </section>
    </div>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900">Recent Traffic Activity</h2>
        <div class="mt-4 max-h-96 overflow-y-auto">
            <div class="space-y-2">
                @forelse($recentTraffic as $event)
                    <div class="rounded-2xl bg-slate-50 px-4 py-2">
                        <div class="flex justify-between gap-2">
                            <span class="text-sm font-medium text-slate-700">{{ $event->action_type }}</span>
                            <span class="text-xs text-slate-500">{{ $event->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <p class="mt-1 text-xs text-slate-500">Page: {{ $event->page_url ?? '—' }}</p>
                        <p class="mt-0.5 text-xs text-slate-500">Visitor: {{ optional($event->user)->name ?? 'Guest' }} | Session {{ $event->session_id ?? 'N/A' }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No recent traffic events yet.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
