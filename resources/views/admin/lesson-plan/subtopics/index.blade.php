@extends('layouts.admin')

@section('title', 'Subtopics')
@section('admin_subtitle', 'Manage subtopics')

@section('content')
<div class="space-y-8">
    <section class="grid gap-4 md:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Subtopics</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($totalSubtopics) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Active Subtopics</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($activeSubtopics) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Topic Count</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($topicCount) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Avg per Topic</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $topicCount > 0 ? number_format($totalSubtopics / $topicCount, 1) : '0' }}</p>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-900">Subtopics</h2>
            <a href="{{ route('admin.subtopics.create') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">Add Subtopic</a>
        </div>

        @if($subtopics->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Topic</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subtopics as $subtopic)
                            <tr class="border-b border-slate-100 hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm text-slate-900">{{ $subtopic->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $subtopic->topic->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($subtopic->is_active)
                                        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Active</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.subtopics.edit', $subtopic) }}" class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50">Edit</a>
                                        <form method="POST" action="{{ route('admin.subtopics.destroy', $subtopic) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-600 shadow-sm hover:bg-red-50">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($subtopics->hasPages())
                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $subtopics->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-12 text-center">
                <p class="text-sm text-slate-500">No subtopics found.</p>
                <a href="{{ route('admin.subtopics.create') }}" class="mt-4 inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">Create First Subtopic</a>
            </div>
        @endif
    </section>
</div>
@endsection
