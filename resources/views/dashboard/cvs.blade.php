@extends('layouts.dashboard')

@section('title', 'My CVs')

@section('content')
<div class="space-y-6">
    @if (session('success'))
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">My CVs</h2>
            <p class="mt-1 text-slate-600">Create, manage, and download your curriculum vitaes.</p>
        </div>
        <a href="{{ url('/tools/cv-builder') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 transition hover:bg-indigo-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New CV
        </a>
    </div>

    @if ($cvs->isEmpty())
        <div class="rounded-3xl border border-slate-200 bg-white p-12 shadow-sm">
            <div class="text-center">
                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-600">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="mb-2 text-lg font-bold text-slate-900">No CVs yet</h3>
                <p class="mx-auto mb-6 max-w-md text-slate-600">Build your first CV using our CV Builder. Create a professional curriculum vitae in minutes.</p>
                <a href="{{ url('/tools/cv-builder') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 transition hover:bg-indigo-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Start Building CV
                </a>
            </div>
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
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
                        @foreach ($cvs as $cv)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-900">{{ $cv->title }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $cv->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $cv->updated_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="relative flex items-center justify-end gap-2" x-data="{ open: false }" @click.outside="open = false">
                                        <a href="{{ route('dashboard.cvs.load', $cv) }}" class="rounded-lg bg-indigo-100 px-3 py-2 text-xs font-medium text-indigo-700 transition hover:bg-indigo-200">
                                            View
                                        </a>

                                        <div class="relative">
                                            <button type="button" @click="open = !open" class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-medium text-slate-700 transition hover:bg-slate-200">
                                                Download
                                            </button>

                                            <div x-show="open" x-transition class="absolute right-0 z-10 mt-2 w-40 rounded-lg border border-slate-200 bg-white shadow-lg">
                                                <a href="{{ route('dashboard.cvs.download', ['cv' => $cv, 'format' => 'pdf']) }}" class="block rounded-t-lg px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                                    PDF
                                                </a>
                                                <a href="{{ route('dashboard.cvs.download', ['cv' => $cv, 'format' => 'word']) }}" class="block rounded-b-lg border-t border-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                                    Word
                                                </a>
                                            </div>
                                        </div>

                                        <form action="{{ route('dashboard.cvs.delete', $cv) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this CV?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg bg-red-100 px-3 py-2 text-xs font-medium text-red-700 transition hover:bg-red-200">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($cvs->hasPages())
            <div class="flex justify-center">
                {{ $cvs->links() }}
            </div>
        @endif
    @endif
</div>
@endsection