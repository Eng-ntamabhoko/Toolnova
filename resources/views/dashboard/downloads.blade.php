@extends('layouts.dashboard')

@section('title', 'Downloads')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-slate-900">Downloads</h2>
        <p class="mt-1 text-slate-600">View your download history and previously generated files.</p>
    </div>

    @if ($downloads->isEmpty())
        <!-- Empty State -->
        <div class="rounded-3xl border border-slate-200 bg-white p-12 shadow-sm">
            <div class="text-center">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-600 mx-auto mb-4">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">No downloads yet</h3>
                <p class="text-slate-600 mb-6 max-w-md mx-auto">Your downloaded files will appear here. Use our tools to create resumes, CVs, invoices, and more, then download them when ready.</p>
                <div class="flex flex-col gap-3 sm:flex-row justify-center">
                    <a href="{{ url('/tools/resume-builder') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 hover:bg-indigo-700 transition">
                        Create Resume
                    </a>
                    <a href="{{ url('/tools/cv-builder') }}" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-200 transition">
                        Create CV
                    </a>
                    <a href="{{ url('/tools/invoice-generator') }}" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-200 transition">
                        Create Invoice
                    </a>
                </div>
            </div>
        </div>

        <!-- Information Section -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 mb-4">About Downloads</h3>
            <div class="space-y-4 text-sm text-slate-600">
                <p>When you create and download files from ToolNova tools, they will be tracked here for your convenience.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="font-medium text-slate-900 mb-2">📄 Resume Builder</p>
                        <p class="text-xs">Create professional resumes and download them as PDF documents.</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="font-medium text-slate-900 mb-2">📋 CV Builder</p>
                        <p class="text-xs">Build comprehensive CVs and export them in multiple formats.</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="font-medium text-slate-900 mb-2">💰 Invoice Generator</p>
                        <p class="text-xs">Generate professional invoices and download as PDF for record keeping.</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <p class="font-medium text-slate-900 mb-2">📊 More Tools</p>
                        <p class="text-xs">Download files from any of our other productivity and utility tools.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Downloads Table -->
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">File Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Type</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Downloaded</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($downloads as $download)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-900">{{ $download->filename ?? 'File' }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    <span class="inline-block rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                        {{ strtoupper($download->file_type ?? 'PDF') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $download->created_at->format('M d, Y H:i') ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <button class="rounded-lg bg-indigo-100 px-3 py-2 text-xs font-medium text-indigo-700 hover:bg-indigo-200 transition">
                                            Download Again
                                        </button>
                                        <button class="rounded-lg bg-red-100 px-3 py-2 text-xs font-medium text-red-700 hover:bg-red-200 transition">
                                            Remove
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($downloads->hasPages())
            <div class="flex justify-center">
                {{ $downloads->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
