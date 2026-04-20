@extends('layouts.admin')

@section('title', 'Message details')
@section('admin_subtitle', 'Contact form submission')

@section('content')
<div class="space-y-8">

    <div>
        <a
            href="{{ route('admin.messages.index', request()->only('type')) }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-slate-900"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to messages
        </a>
        <h1 class="mt-4 text-3xl font-bold text-slate-900">Message details</h1>
        <p class="mt-1 text-slate-500">{{ $message->created_at->format('M j, Y \a\t g:i A') }} · {{ $message->created_at->diffForHumans() }}</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Contact</h2>
            <dl class="mt-4 space-y-4">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Name</dt>
                    <dd class="mt-1 text-sm font-medium text-slate-900">{{ $message->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Email</dt>
                    <dd class="mt-1 text-sm text-slate-800">
                        @if($message->email)
                            <a href="mailto:{{ $message->email }}" class="font-medium text-blue-700 hover:underline">{{ $message->email }}</a>
                        @else
                            <span class="text-slate-500">Not provided</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Phone</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $message->phone ?: 'Not provided' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">WhatsApp</dt>
                    <dd class="mt-1 text-sm">
                        @if($message->whatsapp)
                            <a href="https://wa.me/{{ $message->whatsapp }}?text={{ rawurlencode('Hello '.$message->name) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 font-semibold text-emerald-700 hover:text-emerald-900 hover:underline">
                                Open chat
                                <span class="text-slate-600 font-normal">({{ $message->whatsapp }})</span>
                            </a>
                        @else
                            <span class="text-slate-500">Not provided</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Channel</dt>
                    <dd class="mt-1">
                        @if($message->whatsapp)
                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-900">WhatsApp</span>
                        @elseif($message->phone)
                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-900">Phone</span>
                        @else
                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-800">Email</span>
                        @endif
                    </dd>
                </div>
                @if($message->source_tool)
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Source tool</dt>
                        <dd class="mt-1 text-sm text-slate-800">{{ $message->source_tool }}</dd>
                    </div>
                @endif
                @if($message->source_page)
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Source page</dt>
                        <dd class="mt-1 text-sm">
                            <a href="{{ $message->source_page }}" target="_blank" rel="noopener noreferrer" class="font-medium text-indigo-700 hover:underline">Open page</a>
                        </dd>
                    </div>
                @endif
            </dl>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Meta</h2>
            <dl class="mt-4 space-y-4">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Subject</dt>
                    <dd class="mt-1 text-sm font-medium text-slate-900">{{ $message->subject }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Received</dt>
                    <dd class="mt-1 text-sm text-slate-800">{{ $message->created_at->format('M j, Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-slate-900">Message</h2>
        <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <p class="whitespace-pre-wrap text-slate-800">{{ $message->message }}</p>
        </div>
    </div>
</div>
@endsection
