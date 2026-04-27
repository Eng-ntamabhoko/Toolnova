@extends('layouts.admin')

@section('title', 'Topics')
@section('admin_subtitle', 'Manage topics for subjects')

@section('content')
<div class="space-y-8">
    <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Total Topics</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($totalTopics) }}</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500">Active</p>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($activeTopics) }}</p>
        </div>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Topics</h2>
                <p class="mt-1 text-sm text-slate-500">Manage topics under subjects.</p>
            </div>
            <a href="{{ route('admin.topics.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd"/>
                </svg>
                Add Topic
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-100 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Title</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Subject</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Form</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($topics as $topic)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $topic->title }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $topic->subject->name }}</td>
                            <td class="px-6 py-4 text-sm text-slate-700">{{ $topic->form->name }}</td>
                            <td class="px-6 py-4">
                                @if($topic->is_active)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Active</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.topics.edit', $topic) }}" class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-50">Edit</a>
                                    <form method="POST" action="{{ route('admin.topics.destroy', $topic) }}" onsubmit="return confirm('Are you sure?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500">
                                No topics found. <a href="{{ route('admin.topics.create') }}" class="text-slate-900 underline">Create one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($topics->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $topics->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
