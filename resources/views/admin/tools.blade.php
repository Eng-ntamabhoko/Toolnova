@extends('layouts.admin')

@section('title', 'Tools - Admin')

@section('content')
<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-900">Tools Management</h1>
        <p class="text-slate-500">Enable, monitor and manage tools</p>
    </div>

    {{-- STATS --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @include('admin.partials.stat-card', ['label' => 'Total Tools', 'value' => $totalTools])
        @include('admin.partials.stat-card', ['label' => 'Active Tools', 'value' => $activeTools])
        @include('admin.partials.stat-card', ['label' => 'Featured Tools', 'value' => $featuredTools])
    </div>

    {{-- TOP TOOLS --}}
    <div class="bg-white p-6 rounded-3xl border shadow-sm">
        <h2 class="text-xl font-semibold mb-4">Top Used Tools</h2>

        <div class="space-y-3 max-h-80 overflow-y-auto">
            @forelse($topTools as $tool)
                <div class="flex justify-between items-center bg-slate-50 px-4 py-2 rounded-xl">
                    <span class="font-medium">{{ str_replace('-', ' ', $tool->tool_slug) }}</span>
                    <span class="text-sm font-semibold">{{ number_format($tool->total) }}</span>
                </div>
            @empty
                <p class="text-sm text-slate-500">No usage data yet.</p>
            @endforelse
        </div>
    </div>

    {{-- TOOLS TABLE --}}
    <div class="bg-white p-6 rounded-3xl border shadow-sm">
        <h2 class="text-xl font-semibold mb-4">All Tools</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Slug</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Featured</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($tools as $tool)
                        <tr>
                            <td class="px-4 py-2 font-medium">{{ $tool->name }}</td>

                            <td class="px-4 py-2 text-slate-500">
                                /{{ $tool->slug }}
                            </td>

                            <td class="px-4 py-2">
                                @if($tool->is_active)
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-full">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-full">
                                        Disabled
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-2">
                                @if($tool->is_featured)
                                    ⭐
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tools->links() }}
        </div>
    </div>

</div>
@endsection