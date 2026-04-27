@extends('layouts.admin')

@php
use Illuminate\Support\Str;
@endphp

@section('title', 'Contact messages')
@section('admin_subtitle', 'Inbox from the public contact form')

@section('content')
<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-900">Contact messages</h1>
        <p class="text-slate-500">Read and reply via email or WhatsApp.</p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @include('admin.partials.stat-card', ['label' => 'Total messages', 'value' => number_format($stats['total'])])
        @include('admin.partials.stat-card', ['label' => 'WhatsApp', 'value' => number_format($stats['whatsapp'])])
        @include('admin.partials.stat-card', ['label' => 'Email', 'value' => number_format($stats['email'])])
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Inbox</h2>
                <p class="mt-1 text-sm text-slate-500">Filter by how the visitor chose to be contacted.</p>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-2">
            <a
                href="{{ route('admin.messages.index') }}"
                class="rounded-xl px-4 py-2 text-sm font-medium transition {{ ! $type ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                All
            </a>
            <a
                href="{{ route('admin.messages.index', ['type' => 'whatsapp']) }}"
                class="rounded-xl px-4 py-2 text-sm font-medium transition {{ $type === 'whatsapp' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 text-emerald-800 hover:bg-emerald-100' }}"
            >
                WhatsApp
            </a>
            <a
                href="{{ route('admin.messages.index', ['type' => 'email']) }}"
                class="rounded-xl px-4 py-2 text-sm font-medium transition {{ $type === 'email' ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-800 hover:bg-blue-100' }}"
            >
                Email
            </a>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        @if($messages->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Name</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Subject</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Method</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Contact</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Date</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 sm:px-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($messages as $message)
                            @php
                                $method = 'Unknown';
                                if ($message->whatsapp) {
                                    $method = 'WhatsApp';
                                } elseif ($message->email) {
                                    $method = 'Email';
                                }
                            @endphp
                            <tr class="hover:bg-slate-50/80">
                                <td class="px-4 py-4 font-medium text-slate-900 sm:px-6">{{ $message->name }}</td>
                                <td class="max-w-[200px] px-4 py-4 text-slate-700 sm:px-6">
                                    <span class="line-clamp-2">{{ $message->subject }}</span>
                                </td>
                                <td class="px-4 py-4 sm:px-6">
                                    @if($method === 'WhatsApp')
                                        <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-emerald-900">WhatsApp</span>
                                    @elseif($method === 'Email')
                                        <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-900">Email</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-700">Unknown</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 sm:px-6">
                                    @if($message->whatsapp)
                                        <a href="https://wa.me/{{ $message->whatsapp }}?text={{ rawurlencode('Hello '.$message->name) }}" target="_blank" rel="noopener" class="font-semibold text-emerald-700 hover:text-emerald-900 hover:underline">Chat</a>
                                    @elseif($message->email)
                                        <a href="mailto:{{ $message->email }}" class="text-blue-700 hover:text-blue-900 hover:underline">{{ Str::limit($message->email, 28) }}</a>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-4 text-slate-700 sm:px-6">
                                    <p>{{ $message->created_at->format('M j, Y') }}</p>
                                    <p class="text-xs text-slate-500">{{ $message->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-4 py-4 sm:px-6">
                                    <a
                                        href="{{ route('admin.messages.show', $message) }}"
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
                {{ $messages->links() }}
            </div>
        @else
            <div class="px-6 py-14 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-slate-900">No messages</h3>
                <p class="mt-2 text-sm text-slate-500">
                    @if($type)
                        No messages match this filter.
                    @else
                        Nothing in the inbox yet.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
