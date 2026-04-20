@extends('layouts.admin')

@section('title', 'Settings - Admin')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Settings</h1>
        <p class="text-slate-500">Manage core platform configuration and defaults</p>
    </div>

    @if(session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">General</h2>
                <div class="mt-4 space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Site Name</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Site Tagline</label>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Support Email</label>
                        <input type="email" name="support_email" value="{{ old('support_email', $settings['support_email'] ?? '') }}"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Contact Email</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-400 focus:outline-none">
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">SEO Defaults</h2>
                <div class="mt-4 space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Default Meta Title</label>
                        <input type="text" name="default_meta_title" value="{{ old('default_meta_title', $settings['default_meta_title'] ?? '') }}"
                               class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Default Meta Description</label>
                        <textarea name="default_meta_description" rows="5"
                                  class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-400 focus:outline-none">{{ old('default_meta_description', $settings['default_meta_description'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Feature Toggles</h2>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                @php
                    $toggles = [
                        'enable_user_registration' => 'Enable User Registration',
                        'enable_public_contact_form' => 'Enable Public Contact Form',
                        'enable_blog' => 'Enable Blog',
                        'enable_ads' => 'Enable Ads',
                    ];
                @endphp

                @foreach($toggles as $key => $label)
                    <label class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-3">
                        <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
                        <input type="checkbox" name="{{ $key }}" value="1"
                               {{ old($key, ($settings[$key] ?? '0')) == '1' ? 'checked' : '' }}
                               class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-400">
                    </label>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Maintenance Notice</h2>
            <div class="mt-4">
                <label class="mb-2 block text-sm font-medium text-slate-700">Maintenance Mode Message</label>
                <textarea name="maintenance_mode_message" rows="4"
                          class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-slate-400 focus:outline-none">{{ old('maintenance_mode_message', $settings['maintenance_mode_message'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="rounded-2xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection