@extends('layouts.admin')

@section('title', 'Comment details')
@section('admin_subtitle', 'Review and moderate this comment')

@section('content')
<div class="space-y-8">

    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <a
            href="{{ route('admin.comments') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-slate-900"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to comments
        </a>
        <h1 class="mt-4 text-3xl font-bold text-slate-900">Comment details</h1>
        <p class="mt-1 text-slate-500">Submitted {{ $comment->created_at->format('M j, Y \a\t g:i A') }} · {{ $comment->created_at->diffForHumans() }}</p>
    </div>

    <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:gap-8">
        <div class="min-w-0 flex-1 space-y-6">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Author</h2>
                <div class="mt-4 flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-slate-100 text-base font-semibold text-slate-700">
                        {{ substr($comment->name ?? ($comment->user?->name ?? 'A'), 0, 1) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-lg font-semibold text-slate-900">
                            {{ $comment->name ?? ($comment->user?->name ?? 'Anonymous') }}
                        </p>
                        @if($comment->email)
                            <p class="mt-1 text-sm text-slate-600">{{ $comment->email }}</p>
                        @endif
                        @if($comment->user)
                            <p class="mt-2 text-xs text-slate-500">Registered user ID {{ $comment->user_id }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Context</h2>
                <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Page type</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-900">{{ ucfirst($comment->page_type) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Page slug</dt>
                        <dd class="mt-1 text-sm font-medium text-slate-900">{{ $comment->page_slug }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status</dt>
                        <dd class="mt-1">
                            @if($comment->status === 'pending')
                                <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-medium text-amber-900">Pending</span>
                            @elseif($comment->status === 'approved')
                                <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-900">Approved</span>
                            @else
                                <span class="inline-flex rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-900">Rejected</span>
                            @endif
                        </dd>
                    </div>
                    @if($comment->approved_at)
                        <div>
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Approved at</dt>
                            <dd class="mt-1 text-sm text-slate-900">{{ $comment->approved_at->format('M j, Y \a\t g:i A') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Comment</h2>
                <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <p class="whitespace-pre-wrap text-slate-800">{{ $comment->content }}</p>
                </div>
            </div>
        </div>

        <div class="w-full shrink-0 space-y-3 lg:w-52">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 lg:text-left">Actions</p>
            @if($comment->status === 'pending')
                <form method="POST" action="{{ route('admin.comments.approve', $comment) }}" class="block">
                    @csrf
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Approve
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.comments.reject', $comment) }}" class="block">
                    @csrf
                    <button
                        type="submit"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-700"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reject
                    </button>
                </form>
            @elseif($comment->status === 'approved')
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-center text-sm font-semibold text-emerald-900">
                    Approved
                </div>
            @else
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-center text-sm font-semibold text-red-900">
                    Rejected
                </div>
            @endif
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-slate-900">Admin notes</h2>
        <p class="mt-1 text-sm text-slate-500">Internal notes only; not visible to visitors.</p>

        <form method="POST" action="{{ route('admin.comments.notes', $comment) }}" class="mt-6">
            @csrf
            <label for="admin_notes" class="sr-only">Notes</label>
            <textarea
                id="admin_notes"
                name="admin_notes"
                rows="4"
                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"
                placeholder="Add internal notes about this comment…"
            >{{ old('admin_notes', $comment->admin_notes) }}</textarea>
            @error('admin_notes')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <div class="mt-4 flex justify-end">
                <button
                    type="submit"
                    class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                >
                    Save notes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
