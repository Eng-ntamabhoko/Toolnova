@extends('layouts.dashboard')

@section('title', 'My Resumes')

@section('content')
<div class="space-y-6">
    <!-- Header with CTA Button -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">My Resumes</h2>
            <p class="mt-1 text-slate-600">Create, manage, and download your resumes.</p>
        </div>
        <a href="{{ url('/tools/resume-builder') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 hover:bg-indigo-700 transition">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New Resume
        </a>
    </div>

    @if ($resumes->isEmpty())
        <!-- Empty State -->
        <div class="rounded-3xl border border-slate-200 bg-white p-12 shadow-sm">
            <div class="text-center">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-600 mx-auto mb-4">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">No resumes yet</h3>
                <p class="text-slate-600 mb-6 max-w-md mx-auto">Create your first resume using our Resume Builder. It's easy, fast, and helps you stand out to employers.</p>
                <a href="{{ url('/tools/resume-builder') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 hover:bg-indigo-700 transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Start Building Resume
                </a>
            </div>
        </div>
    @else
        <!-- Resumes Table -->
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Created</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Modified</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($resumes as $resume)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-900">{{ $resume->name ?? 'Resume' }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $resume->created_at->format('M d, Y') ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $resume->updated_at->format('M d, Y') ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <button class="rounded-lg bg-indigo-100 px-3 py-2 text-xs font-medium text-indigo-700 hover:bg-indigo-200 transition">
                                            Edit
                                        </button>
                                        <button class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-200 transition">
                                            Download
                                        </button>
                                        <button class="rounded-lg bg-red-100 px-3 py-2 text-xs font-medium text-red-700 hover:bg-red-200 transition">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($resumes->hasPages())
            <div class="flex justify-center">
                {{ $resumes->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
