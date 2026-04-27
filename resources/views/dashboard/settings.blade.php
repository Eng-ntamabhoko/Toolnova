@extends('layouts.dashboard')

@section('title', 'Account Settings')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h2 class="text-2xl font-bold text-slate-900">Account Settings</h2>
        <p class="mt-1 text-slate-600">Manage your account security, preferences, and settings.</p>
    </div>

    <!-- Personal Information Section -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Personal Information</h3>
        
        <form action="#" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                    <input
                        type="text"
                        value="{{ auth()->user()->name }}"
                        disabled
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-slate-900 text-sm"
                    />
                    <p class="text-xs text-slate-500 mt-1">To change your name, please contact support.</p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                    <input
                        type="email"
                        value="{{ auth()->user()->email }}"
                        disabled
                        class="w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2.5 text-slate-900 text-sm"
                    />
                    <p class="text-xs text-slate-500 mt-1">To change your email, please contact support.</p>
                </div>
            </div>
        </form>
    </div>

    <!-- Password & Security Section -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Password & Security</h3>
        
        <div class="space-y-4">
            <!-- Change Password -->
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-slate-900">Change Password</p>
                        <p class="text-sm text-slate-600 mt-0.5">Update your account password regularly for security.</p>
                    </div>
                    <button
                        type="button"
                        class="rounded-lg bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200 transition"
                        x-data="{ open: false }"
                        @click="open = !open"
                    >
                        Change
                    </button>
                </div>
            </div>

            <!-- Two-Factor Authentication (Placeholder) -->
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-slate-900">Two-Factor Authentication</p>
                        <p class="text-sm text-slate-600 mt-0.5">Add an extra layer of security to your account.</p>
                    </div>
                    <span class="inline-block rounded-full bg-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-slate-700">
                        Coming Soon
                    </span>
                </div>
            </div>

            <!-- Active Sessions (Placeholder) -->
            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-slate-900">Active Sessions</p>
                        <p class="text-sm text-slate-600 mt-0.5">View and manage all your active login sessions.</p>
                    </div>
                    <span class="inline-block rounded-full bg-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-slate-700">
                        Coming Soon
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Preferences Section -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Preferences</h3>
        
        <form action="#" method="POST" class="space-y-6">
            @csrf
            
            <!-- Email Notifications -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-3">Email Notifications</label>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input type="checkbox" id="email-updates" checked class="rounded border-slate-300 text-indigo-600" />
                        <label for="email-updates" class="ml-3 text-sm text-slate-700">
                            Send me email updates about new features and improvements
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="email-news" checked class="rounded border-slate-300 text-indigo-600" />
                        <label for="email-news" class="ml-3 text-sm text-slate-700">
                            Send me newsletters with tips and resources
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="email-security" checked class="rounded border-slate-300 text-indigo-600" />
                        <label for="email-security" class="ml-3 text-sm text-slate-700">
                            Send me security alerts and notifications
                        </label>
                    </div>
                </div>
            </div>

            <!-- Theme Preference (Placeholder) -->
            <div>
                <label for="theme" class="block text-sm font-medium text-slate-700 mb-2">Theme Preference</label>
                <select id="theme" class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-slate-900 text-sm">
                    <option>Light (Default)</option>
                    <option>Dark</option>
                    <option>System</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Data & Privacy Section -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Data & Privacy</h3>
        
        <div class="space-y-3">
            <a href="{{ route('privacy') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 p-4 hover:bg-indigo-50 hover:border-indigo-200 transition">
                <div>
                    <p class="font-medium text-slate-900">Privacy Policy</p>
                    <p class="text-sm text-slate-600 mt-0.5">Read our privacy policy</p>
                </div>
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="{{ route('terms') }}" class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 p-4 hover:bg-indigo-50 hover:border-indigo-200 transition">
                <div>
                    <p class="font-medium text-slate-900">Terms of Service</p>
                    <p class="text-sm text-slate-600 mt-0.5">Review our terms of service</p>
                </div>
                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <div class="rounded-lg border border-red-200 bg-red-50 p-4">
                <div class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-red-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v2m0-6h0m0 0h0" />
                    </svg>
                    <div>
                        <p class="font-medium text-red-900">Delete Account</p>
                        <p class="text-sm text-red-800 mt-0.5">Permanently delete your account and all associated data. This action cannot be undone.</p>
                        <button type="button" class="mt-3 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 transition">
                            Delete My Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex gap-3">
        <button
            type="button"
            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 hover:bg-indigo-700 transition"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Save Changes
        </button>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-900 hover:bg-slate-50 transition">
            Cancel
        </a>
    </div>
</div>
@endsection
