@extends('layouts.admin')

@section('title', 'Comments Management')
@section('admin_subtitle', 'Moderate and manage user comments')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-900">Comments</h1>
        <p class="text-slate-500">Review, approve, or reject user comments on tools and pages.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @include('admin.partials.stat-card', ['label' => 'Total comments', 'value' => number_format($stats['totalComments'])])
        @include('admin.partials.stat-card', ['label' => 'Pending review', 'value' => number_format($stats['pendingComments'])])
        @include('admin.partials.stat-card', ['label' => 'Approved', 'value' => number_format($stats['approvedComments'])])
        @include('admin.partials.stat-card', ['label' => 'Rejected', 'value' => number_format($stats['rejectedComments'])])
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Filter</h2>
                <p class="mt-1 text-sm text-slate-500">{{ $stats['pendingComments'] }} pending approval</p>
            </div>

            @if($stats['pendingComments'] > 0)
                <a
                    href="{{ route('admin.comments', ['status' => 'pending']) }}"
                    class="inline-flex shrink-0 items-center justify-center rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-600"
                >
                    Review pending ({{ $stats['pendingComments'] }})
                </a>
            @endif
        </div>

        <div class="mt-6 flex flex-wrap gap-2">
            <a
                href="{{ route('admin.comments') }}"
                class="rounded-xl px-4 py-2 text-sm font-medium transition {{ ! $status ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                All
            </a>
            <a
                href="{{ route('admin.comments', ['status' => 'pending']) }}"
                class="rounded-xl px-4 py-2 text-sm font-medium transition {{ $status === 'pending' ? 'bg-amber-600 text-white' : 'bg-amber-50 text-amber-800 hover:bg-amber-100' }}"
            >
                Pending
            </a>
            <a
                href="{{ route('admin.comments', ['status' => 'approved']) }}"
                class="rounded-xl px-4 py-2 text-sm font-medium transition {{ $status === 'approved' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100' }}"
            >
                Approved
            </a>
            <a
                href="{{ route('admin.comments', ['status' => 'rejected']) }}"
                class="rounded-xl px-4 py-2 text-sm font-medium transition {{ $status === 'rejected' ? 'bg-red-600 text-white' : 'bg-red-50 text-red-800 hover:bg-red-100' }}"
            >
                Rejected
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        @if($comments->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">User</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Page</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Content</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Date</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($comments as $comment)
                            <tr class="hover:bg-slate-50/80">
                                <td class="px-4 py-4 align-top sm:px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-700">
                                            {{ substr($comment->name ?? ($comment->user?->name ?? 'A'), 0, 1) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-medium text-slate-900">
                                                {{ $comment->name ?? ($comment->user?->name ?? 'Anonymous') }}
                                            </p>
                                            @if($comment->email)
                                                <p class="truncate text-xs text-slate-500">{{ $comment->email }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 align-top text-slate-700 sm:px-6">
                                    <p class="font-medium text-slate-900">{{ ucfirst($comment->page_type) }}</p>
                                    <p class="text-xs text-slate-500">{{ $comment->page_slug }}</p>
                                </td>
                                <td class="max-w-xs px-4 py-4 align-top text-slate-700 sm:px-6">
                                    <p class="line-clamp-2">{{ Str::limit($comment->content, 120) }}</p>
                                </td>
                                <td class="px-4 py-4 align-top sm:px-6">
                                    @if($comment->status === 'pending')
                                        <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-900">Pending</span>
                                    @elseif($comment->status === 'approved')
                                        <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-900">Approved</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-900">Rejected</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 align-top text-slate-700 sm:px-6">
                                    <p>{{ $comment->created_at->format('M j, Y') }}</p>
                                    <p class="text-xs text-slate-500">{{ $comment->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-4 py-4 align-top sm:px-6">
                                    <a
                                        href="{{ route('admin.comments.show', $comment) }}"
                                        class="inline-flex rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-800 transition hover:bg-slate-200"
                                    >
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 px-6 py-4">
                {{ $comments->links() }}
            </div>
        @else
            <div class="px-6 py-14 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-slate-900">No comments found</h3>
                <p class="mt-2 text-sm text-slate-500">
                    @if($status)
                        No {{ $status }} comments match this filter.
                    @else
                        No comments have been submitted yet.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
