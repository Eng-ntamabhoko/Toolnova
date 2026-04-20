@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
<div class="space-y-6">
    <!-- Profile Header -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white text-2xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">{{ $user->name }}</h2>
                    <p class="text-slate-600">{{ $user->email }}</p>
                    @if ($user->role === 'admin')
                        <span class="mt-1 inline-block rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-purple-700">
                            Administrator
                        </span>
                    @else
                        <span class="mt-1 inline-block rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-blue-700">
                            Member
                        </span>
                    @endif
                </div>
            </div>
            <a href="{{ route('dashboard.settings') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200 transition">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Profile
            </a>
        </div>
    </div>

    <!-- Profile Information -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Account Information</h3>
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                <div class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                    {{ $user->name }}
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                <div class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                    {{ $user->email }}
                </div>
            </div>

            <!-- Account Type -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Account Type</label>
                <div class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                    @if ($user->role === 'admin')
                        <span class="inline-block rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">
                            Administrator
                        </span>
                    @else
                        <span class="inline-block rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                            Member
                        </span>
                    @endif
                </div>
            </div>

            <!-- Member Since -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Member Since</label>
                <div class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900">
                    {{ $user->created_at->format('F j, Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Summary -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Activity Summary</h3>
        
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-medium text-slate-600 mb-1">Account Created</p>
                <p class="text-lg font-bold text-slate-900">{{ $user->created_at->format('M d, Y') }}</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-medium text-slate-600 mb-1">Last Updated</p>
                <p class="text-lg font-bold text-slate-900">{{ $user->updated_at->format('M d, Y') }}</p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm font-medium text-slate-600 mb-1">Documents Created</p>
                <p class="text-lg font-bold text-slate-900">0</p>
                <p class="text-xs text-slate-500 mt-1">Track your activity</p>
            </div>
        </div>
    </div>

    <!-- Security Section -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Security & Privacy</h3>
        <p class="text-slate-600 text-sm mb-6">Manage your account security and privacy settings.</p>
        
        <div class="space-y-3">
            <a href="{{ route('dashboard.settings') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 p-4 hover:bg-indigo-50 hover:border-indigo-200 transition">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Change Password</p>
                        <p class="text-xs text-slate-500">Update your account password</p>
                    </div>
                </div>
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="{{ route('dashboard.settings') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 p-4 hover:bg-indigo-50 hover:border-indigo-200 transition">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Email Notifications</p>
                        <p class="text-xs text-slate-500">Manage notification preferences</p>
                    </div>
                </div>
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
