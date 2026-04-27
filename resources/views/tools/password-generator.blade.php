@extends('layouts.app')

@section('title', 'Password Generator - ToolNova')
@section('meta_description', 'Generate strong random passwords with uppercase letters, numbers and symbols using ToolNova Password Generator.')

@section('content')
<div x-data="passwordGenerator()" data-tool-slug="password-generator" class="bg-slate-50">

    <!-- Hero -->
    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-blue-200">
                    Free Online Tool
                </span>

                <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-white sm:text-5xl">
                    Password Generator
                </h1>

                <p class="mt-4 max-w-2xl text-lg leading-8 text-slate-300">
                    Generate secure random passwords for email, apps, social media, websites and business accounts in seconds.
                </p>
            </div>
        </div>
    </section>

    <!-- Tool Area -->
    <section class="py-10 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-12">

                <!-- Controls -->
                <aside class="lg:col-span-5">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V7.875a4.5 4.5 0 1 0-9 0V10.5m-.75 0h10.5A1.5 1.5 0 0 1 18.75 12v6A1.5 1.5 0 0 1 17.25 19.5H6.75A1.5 1.5 0 0 1 5.25 18v-6A1.5 1.5 0 0 1 6.75 10.5Z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">Password settings</h2>
                                <p class="text-sm text-slate-500">Adjust the options below.</p>
                            </div>
                        </div>

                        <div class="mt-8 space-y-6">
                            <div>
                                <div class="mb-2 flex items-center justify-between">
                                    <label for="length" class="text-sm font-semibold text-slate-700">Password Length</label>
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700" x-text="length"></span>
                                </div>

                                <input
                                    id="length"
                                    type="range"
                                    min="4"
                                    max="64"
                                    x-model="length"
                                    class="w-full"
                                >
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-4">
                                    <input type="checkbox" x-model="includeUppercase" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                                    <span class="text-sm font-medium text-slate-700">Uppercase Letters</span>
                                </label>

                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-4">
                                    <input type="checkbox" x-model="includeLowercase" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                                    <span class="text-sm font-medium text-slate-700">Lowercase Letters</span>
                                </label>

                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-4">
                                    <input type="checkbox" x-model="includeNumbers" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                                    <span class="text-sm font-medium text-slate-700">Numbers</span>
                                </label>

                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-4">
                                    <input type="checkbox" x-model="includeSymbols" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                                    <span class="text-sm font-medium text-slate-700">Symbols</span>
                                </label>

                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-4">
                                    <input type="checkbox" x-model="avoidSimilar" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                                    <span class="text-sm font-medium text-slate-700">Avoid Similar Characters</span>
                                </label>

                                <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-4">
                                    <input type="checkbox" x-model="excludeAmbiguousSymbols" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                                    <span class="text-sm font-medium text-slate-700">Exclude Ambiguous Symbols</span>
                                </label>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <button
                                    type="button"
                                    @click="generatePassword()"
                                    class="rounded-2xl bg-blue-600 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-blue-700"
                                >
                                    Generate Password
                                </button>

                                <button
                                    type="button"
                                    @click="sharePasswordTool()"
                                    class="rounded-2xl border border-slate-300 px-6 py-3.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    Share Tool
                                </button>
                            </div>

                            <div
                                x-show="error"
                                x-transition
                                class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                            >
                                <span x-text="error"></span>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Results -->
                <div class="lg:col-span-7 space-y-8">

                    <!-- Password Output -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">Generated Password</h2>
                                <p class="mt-1 text-slate-500">Use the generated password for better security.</p>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <button
                                    type="button"
                                    @click="copyPassword()"
                                    class="rounded-2xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    <span x-text="copied ? 'Copied' : 'Copy'"></span>
                                </button>

                                <button
                                    type="button"
                                    @click="generatePassword()"
                                    class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-600"
                                >
                                    Regenerate
                                </button>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <p class="break-all font-mono text-lg text-slate-900" x-text="password || 'Your generated password will appear here.'"></p>
                        </div>

                        <div class="mt-6">
                            <div class="mb-2 flex items-center justify-between">
                                <p class="text-sm font-medium text-slate-600">Password Strength</p>
                                <p class="text-sm font-semibold text-slate-900" x-text="strengthLabel"></p>
                            </div>

                            <div class="h-3 w-full overflow-hidden rounded-full bg-slate-200">
                                <div
                                    class="h-full rounded-full transition-all duration-300"
                                    :class="strengthColor"
                                    :style="`width: ${strengthWidth}%`"
                                ></div>
                            </div>
                        </div>
                    </section>

                    <!-- Tips -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h2 class="text-2xl font-bold text-slate-900">Password Tips</h2>
                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <div class="rounded-2xl border border-slate-200 p-5">
                                <h3 class="font-semibold text-slate-900">Use longer passwords</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Longer passwords are usually more difficult to guess or crack than short ones.
                                </p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <h3 class="font-semibold text-slate-900">Mix character types</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Combining uppercase, lowercase, numbers and symbols improves password strength.
                                </p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <h3 class="font-semibold text-slate-900">Avoid reused passwords</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Using the same password in multiple places can increase security risk.
                                </p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <h3 class="font-semibold text-slate-900">Store safely</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Save strong passwords in a secure password manager when possible.
                                </p>
                            </div>
                        </div>
                    </section>

                    <!-- How to Use -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <button
                            type="button"
                            @click="openHowTo = !openHowTo"
                            class="flex w-full items-center justify-between gap-4 text-left"
                        >
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">How to Use</h2>
                                <p class="mt-1 text-slate-500">Click to view the steps.</p>
                            </div>

                            <div class="rounded-2xl bg-slate-100 p-3 text-slate-700">
                                <svg x-show="!openHowTo" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <svg x-show="openHowTo" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                </svg>
                            </div>
                        </button>

                        <div x-show="openHowTo" x-transition class="mt-6">
                            <ol class="space-y-4 text-slate-600">
                                <li><strong class="text-slate-900">1.</strong> Choose the password length you want.</li>
                                <li><strong class="text-slate-900">2.</strong> Select the character types to include.</li>
                                <li><strong class="text-slate-900">3.</strong> Turn on or off extra options like avoiding similar characters.</li>
                                <li><strong class="text-slate-900">4.</strong> Copy the generated password and use it where needed.</li>
                            </ol>
                        </div>
                    </section>

                    <!-- Why Use -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h2 class="text-2xl font-bold text-slate-900">Why Use This Tool</h2>
                        <p class="mt-5 leading-7 text-slate-600">
                            This password generator helps users create stronger passwords for email accounts, websites,
                            apps, online services, work tools and personal logins without having to invent passwords manually.
                        </p>
                    </section>

                    <!-- FAQ -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">Frequently Asked Questions</h2>
                            <p class="mt-1 text-slate-500">Tap a question to view the answer.</p>
                        </div>

                        <div class="mt-6 space-y-4">
                            <template x-for="(item, index) in faqItems" :key="index">
                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <button
                                        type="button"
                                        @click="toggleFaq(index)"
                                        class="flex w-full items-center justify-between gap-4 bg-white px-5 py-4 text-left"
                                    >
                                        <span class="font-semibold text-slate-900" x-text="item.q"></span>

                                        <span class="rounded-full bg-slate-100 p-2 text-slate-700">
                                            <svg x-show="openFaq !== index" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            <svg x-show="openFaq === index" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </span>
                                    </button>

                                    <div x-show="openFaq === index" x-transition class="border-t border-slate-200 bg-slate-50 px-5 py-4 text-slate-600">
                                        <p x-text="item.a"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </section>

                    <!-- SEO Related -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">Related Utility Tools</h2>
                                <p class="mt-1 text-slate-500">
                                    Explore more useful tools for security, text and everyday online tasks.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/word-counter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Word Counter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Count words, characters, sentences and reading time instantly.
                                </p>
                            </a>

                            <a href="{{ url('/tools/json-formatter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">JSON Formatter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Format and beautify JSON data for development and debugging tasks.
                                </p>
                            </a>

                            <a href="{{ url('/tools/age-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Age Calculator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Calculate exact age in years, months, days and more with useful date insights.
                                </p>
                            </a>
                        </div>

                        <div class="mt-10 grid gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">When a password generator is useful</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    A password generator is useful when creating new accounts, updating old passwords,
                                    setting safer login credentials or improving online security across multiple services.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-slate-900">What makes a stronger password</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    Stronger passwords often use greater length and a mix of uppercase letters,
                                    lowercase letters, numbers and symbols while avoiding predictable patterns.
                                </p>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>
</div>

@include('components.support-box')

@include('components.comments-section', [
    'pageType' => 'tool',
    'pageSlug' => 'password-generator',
    'comments' => $comments ?? collect()
])

@endsection