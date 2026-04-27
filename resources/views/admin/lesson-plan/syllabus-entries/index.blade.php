@extends('layouts.admin')

@section('title', 'Syllabus Entries')
@section('admin_subtitle', 'Manage syllabus entries')

@section('content')
<div class="space-y-8">
    <section class="grid gap-4 md:grid-cols-4">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Entries</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($totalEntries) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Forms</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($formCount) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Subjects</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($subjectCount) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Topics</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($topicCount) }}</p>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-900">Syllabus Entries</h2>
            <a href="{{ route('admin.syllabus-entries.create') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">Add Entry</a>
        </div>

        @if($entries->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Main Competence</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Form</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Subject</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase text-slate-500">Topic</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $entry)
                            <tr class="border-b border-slate-100 hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm text-slate-900">{{ Str::limit($entry->main_competence, 50) }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $entry->form->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $entry->subject->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $entry->topic->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.syllabus-entries.edit', $entry) }}" class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50">Edit</a>
                                        <form method="POST" action="{{ route('admin.syllabus-entries.destroy', $entry) }}" class="inline" onsubmit="return confirm('Are you sure?');">
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

            @if($entries->hasPages())
                <div class="border-t border-slate-100 px-6 py-4">
                    {{ $entries->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-12 text-center">
                <p class="text-sm text-slate-500">No syllabus entries found.</p>
                <a href="{{ route('admin.syllabus-entries.create') }}" class="mt-4 inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">Create First Entry</a>
            </div>
        @endif
    </section>
</div>
@endsection
