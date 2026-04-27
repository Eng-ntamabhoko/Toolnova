@extends('layouts.admin')

@section('title', 'Tool Usage')
@section('admin_subtitle', 'Measure interactions, page views, trends, and recent tool activity')

@section('content')
<div class="space-y-8">
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Tool Uses</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($totalToolUses) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Tool Page Views</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($totalPageViews) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Most Used Tool</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($mostUsedTool->total ?? 0) }}</p>
            <p class="mt-2 text-sm text-slate-500">{{ $mostUsedTool->tool_name ?? 'N/A' }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Most Viewed Tool</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($mostViewedTool->total ?? 0) }}</p>
            <p class="mt-2 text-sm text-slate-500">{{ $mostViewedTool->tool_name ?? 'N/A' }}</p>
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Top Tools by Uses</h2>
                <p class="mt-1 text-sm text-slate-500">Highest interaction counts based on tool use events.</p>
            </div>
            <div class="max-h-96 overflow-y-auto p-4">
                <div class="space-y-3">
                    @forelse($topToolUses as $item)
                        <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                            <span class="font-medium text-slate-700">{{ $item->tool_name }}</span>
                            <span class="text-sm font-semibold text-slate-900">{{ number_format($item->total) }}</span>
                        </div>
                    @empty
                        <p class="px-2 text-sm text-slate-500">No tool use data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-900">Top Tools by Page Views</h2>
                <p class="mt-1 text-sm text-slate-500">Most viewed tool pages across tracked traffic.</p>
            </div>
            <div class="max-h-96 overflow-y-auto p-4">
                <div class="space-y-3">
                    @forelse($topPageViews as $item)
                        <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3">
                            <span class="font-medium text-slate-700">{{ $item->tool_name }}</span>
                            <span class="text-sm font-semibold text-slate-900">{{ number_format($item->total) }}</span>
                        </div>
                    @empty
                        <p class="px-2 text-sm text-slate-500">No page view data yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-900">Daily Tool Activity (Last 7 Days)</h2>
            <p class="mt-1 text-sm text-slate-500">Tool use activity trend based on interaction events only.</p>
        </div>

        <div class="p-4 sm:p-6">
            <div class="overflow-x-auto rounded-2xl border border-slate-200">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Date</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Uses</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach($chartLabels as $idx => $label)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-slate-700">{{ $label }}</td>
                                <td class="px-4 py-3 text-right font-semibold text-slate-900">{{ number_format($chartUses[$idx] ?? 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <input type="hidden" id="chartLabels" value='{{ json_encode($chartLabels) }}'>
            <input type="hidden" id="chartUses" value='{{ json_encode($chartUses) }}'>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-900">Recent Tool Activity</h2>
            <p class="mt-1 text-sm text-slate-500">Latest tracked events for tools and related interaction.</p>
        </div>

        <div class="max-h-[32rem] overflow-y-auto p-4 sm:p-6">
            <div class="overflow-x-auto rounded-2xl border border-slate-200">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">When</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tool</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Action</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">User</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($recentActivity as $activity)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-slate-700">{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                                <td class="px-4 py-3 text-slate-700">
                                    {{
                                        optional($activity->tool)->name
                                        ?? \Illuminate\Support\Str::of($activity->tool_slug ?? 'Unknown Tool')->replace('-', ' ')->title()
                                    }}
                                </td>
                                <td class="px-4 py-3 text-slate-700">{{ $activity->action_type }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ optional($activity->user)->name ?? 'Guest' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-slate-500">No recent activity yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection