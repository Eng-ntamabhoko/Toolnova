@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Welcome back, {{ auth()->user()->name }}!</h2>
                <p class="mt-1 text-slate-600">Here's your account overview and recent activity.</p>
            </div>
            <div class="hidden sm:flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white text-2xl font-bold">
                👋
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Resumes Card -->
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Resumes</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_resumes'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('dashboard.resumes') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                View Resumes
                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Total CVs Card -->
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total CVs</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_cvs'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100 text-purple-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('dashboard.cvs') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                View CVs
                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Total Invoices Card -->
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Invoices</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_invoices'] }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-green-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('dashboard.invoices') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                View Invoices
                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Downloads Card -->
        <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Downloads</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">0</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('dashboard.downloads') }}" class="mt-4 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                View Downloads
                <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ url('/tools/resume-builder') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-4 hover:bg-indigo-50 hover:border-indigo-200 transition">
                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-slate-900">Create Resume</p>
                    <p class="text-xs text-slate-500">Build a new resume</p>
                </div>
            </a>

            <a href="{{ url('/tools/cv-builder') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-4 hover:bg-indigo-50 hover:border-indigo-200 transition">
                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-slate-900">Create CV</p>
                    <p class="text-xs text-slate-500">Build a new CV</p>
                </div>
            </a>

            <a href="{{ url('/tools/invoice-generator') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-4 hover:bg-indigo-50 hover:border-indigo-200 transition">
                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-slate-900">Create Invoice</p>
                    <p class="text-xs text-slate-500">Generate a new invoice</p>
                </div>
            </a>

            <a href="{{ route('dashboard.settings') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-4 hover:bg-indigo-50 hover:border-indigo-200 transition">
                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-slate-900">Settings</p>
                    <p class="text-xs text-slate-500">Manage your account</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Information Section -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Getting Started</h3>
        <div class="space-y-3">
            <p class="text-sm text-slate-600">Welcome to your ToolNova account dashboard! Here you can:</p>
            <ul class="space-y-2 text-sm text-slate-600">
                <li class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>View and manage your resumes, CVs, and invoices</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Create new documents using our tools</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Download and download your created documents</span>
                </li>
                <li class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Update your profile and account settings</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
