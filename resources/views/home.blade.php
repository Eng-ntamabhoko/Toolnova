@extends('layouts.app')

@section('title', 'ToolNova - Free Online Tools')
@section('meta_description', 'Free online tools for calculations, text, images, coding, business and productivity.')

@section('content')
<div class="bg-slate-50">

    <!-- Hero -->
    <section class="relative isolate overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(59,130,246,0.22),transparent_35%),radial-gradient(circle_at_bottom_right,rgba(14,165,233,0.18),transparent_30%)]"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-950 to-slate-900"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-blue-200 sm:text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.25 4.5a.75.75 0 0 1 1.5 0v6.19l4.72 2.72a.75.75 0 0 1-.75 1.3l-5.1-2.94a.75.75 0 0 1-.37-.65V4.5Z"/>
                            <path fill-rule="evenodd" d="M12 2.25a9.75 9.75 0 1 0 9.75 9.75A9.761 9.761 0 0 0 12 2.25Zm-8.25 9.75a8.25 8.25 0 1 1 8.25 8.25A8.259 8.259 0 0 1 3.75 12Z" clip-rule="evenodd"/>
                        </svg>
                        Fast • Free • Useful
                    </span>

                    <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-transparent sm:text-5xl lg:text-6xl bg-gradient-to-r from-cyan-300 via-blue-300 to-fuchsia-400 bg-clip-text animate-gradient-text">
                        Powerful online tools with a cleaner, smarter experience
                    </h1>

                    <p class="mt-5 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg sm:leading-8">
                        Use polished tools for calculations, text editing, coding, image tasks, invoices, resumes and everyday productivity — all in one place.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ url('/tools') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-blue-900/20 transition hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10.5 6a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 6Z"/>
                                <path d="M10.5 12a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 12Z"/>
                                <path d="M10.5 18a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 18Z"/>
                                <path fill-rule="evenodd" d="M3.75 5.25A2.25 2.25 0 0 1 6 3h1.5a2.25 2.25 0 0 1 2.25 2.25v1.5A2.25 2.25 0 0 1 7.5 9H6a2.25 2.25 0 0 1-2.25-2.25v-1.5Zm2.25-.75a.75.75 0 0 0-.75.75v1.5c0 .414.336.75.75.75h1.5a.75.75 0 0 0 .75-.75v-1.5a.75.75 0 0 0-.75-.75H6Zm-2.25 12A2.25 2.25 0 0 1 6 14.25h1.5a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 7.5 20.25H6A2.25 2.25 0 0 1 3.75 18v-1.5ZM6 15.75a.75.75 0 0 0-.75.75V18c0 .414.336.75.75.75h1.5a.75.75 0 0 0 .75-.75v-1.5a.75.75 0 0 0-.75-.75H6Z" clip-rule="evenodd"/>
                            </svg>
                            Explore All Tools
                        </a>

                        <a href="{{ url('/tools/resume-builder') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.5 3.75A2.25 2.25 0 0 0 5.25 6v12A2.25 2.25 0 0 0 7.5 20.25h9A2.25 2.25 0 0 0 18.75 18V8.56a2.25 2.25 0 0 0-.659-1.591l-2.81-2.81A2.25 2.25 0 0 0 13.69 3.5H7.5Zm6 .75v3a.75.75 0 0 0 .75.75h3v9.75a.75.75 0 0 1-.75.75h-9a.75.75 0 0 1-.75-.75V6a.75.75 0 0 1 .75-.75h6Z" clip-rule="evenodd"/>
                            </svg>
                            Open Resume Builder
                        </a>
                    </div>
                </div>

                <div class="lg:justify-self-end">
                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-4 shadow-2xl shadow-slate-950/40 backdrop-blur">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl bg-white p-5 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12 2.25a9.75 9.75 0 1 0 9.75 9.75A9.761 9.761 0 0 0 12 2.25Zm0 3a.75.75 0 0 1 .75.75v5.69l3.28 1.9a.75.75 0 1 1-.75 1.3l-3.65-2.11a.75.75 0 0 1-.38-.65V6a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">Fast Results</p>
                                        <p class="text-xs text-slate-500">Quick and responsive tool pages</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-3xl bg-white p-5 shadow-sm">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12 1.5a.75.75 0 0 1 .75.75v1.153a8.25 8.25 0 0 1 6.77 6.77h1.153a.75.75 0 0 1 0 1.5H19.52a8.25 8.25 0 0 1-6.77 6.77v1.153a.75.75 0 0 1-1.5 0V20.52a8.25 8.25 0 0 1-6.77-6.77H3.327a.75.75 0 0 1 0-1.5H4.48a8.25 8.25 0 0 1 6.77-6.77V2.25A.75.75 0 0 1 12 1.5Zm0 3.375a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5Z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">Useful Utilities</p>
                                        <p class="text-xs text-slate-500">Built for real everyday tasks</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-3xl bg-white p-5 shadow-sm sm:col-span-2">
                                <div class="flex items-start gap-4">
                                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-100 text-violet-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M4.5 5.25A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25Z"/>
                                            <path fill="#fff" d="M8.25 7.5h7.5v1.5h-7.5zm0 3h7.5V12h-7.5zm0 3h4.5V15h-4.5z"/>
                                        </svg>
                                    </span>
                                    <div>
                                        <p class="text-base font-bold text-slate-900">Professional tools, cleaner experience</p>
                                        <p class="mt-2 text-sm leading-6 text-slate-600">
                                            Open calculators, text utilities, image tools, coding helpers and document builders from one organized platform.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative border-t border-white/10">
            <div class="mx-auto grid max-w-7xl gap-4 px-4 py-6 text-sm text-slate-300 sm:grid-cols-3 sm:px-6 lg:px-8">
                <div class="flex items-center gap-3">
                    <span class="rounded-xl bg-white/5 p-2 text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.25 3.75a.75.75 0 0 1 1.5 0v8.25h8.25a.75.75 0 0 1 0 1.5h-8.25v8.25a.75.75 0 0 1-1.5 0V13.5H3a.75.75 0 0 1 0-1.5h8.25V3.75Z"/>
                        </svg>
                    </span>
                    <span>16 active tools</span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="rounded-xl bg-white/5 p-2 text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.75 5.25A2.25 2.25 0 0 1 6 3h12a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 18 21H6a2.25 2.25 0 0 1-2.25-2.25V5.25ZM6 4.5a.75.75 0 0 0-.75.75v2.25h13.5V5.25A.75.75 0 0 0 18 4.5H6Z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <span>Clean, organized tool pages</span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="rounded-xl bg-white/5 p-2 text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 1.5a8.25 8.25 0 0 0-8.25 8.25c0 2.187.85 4.176 2.236 5.655-.24.852-.65 1.83-1.392 2.854a.75.75 0 0 0 .952 1.124c1.16-.57 2.323-.96 3.21-1.202A8.214 8.214 0 0 0 12 18a8.25 8.25 0 1 0 0-16.5Z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                    <span>Built for simple daily use</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Tools -->
    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 sm:text-3xl">Popular Tools</h2>
                    <p class="mt-2 text-slate-600">
                        Quick access to useful tools with a cleaner layout.
                    </p>
                </div>

                <a href="{{ url('/tools') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700">
                    View all tools
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.97 4.97a.75.75 0 0 1 1.06 0l6 6a.75.75 0 0 1 0 1.06l-6 6a.75.75 0 1 1-1.06-1.06l4.72-4.72H4.5a.75.75 0 0 1 0-1.5h13.19l-4.72-4.72a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <a href="{{ url('/tools/age-calculator') }}" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-50/30">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v.75h9V3a.75.75 0 0 1 1.5 0v.75h.75A2.25 2.25 0 0 1 21 6v12.75A2.25 2.25 0 0 1 18.75 21H5.25A2.25 2.25 0 0 1 3 18.75V6a2.25 2.25 0 0 1 2.25-2.25H6V3a.75.75 0 0 1 .75-.75ZM4.5 9.75v9a.75.75 0 0 0 .75.75h13.5a.75.75 0 0 0 .75-.75v-9H4.5Z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-700">Age Calculator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Calculate exact age in years, months, days and more.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/tools/word-counter') }}" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-50/30">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7.5 6.75h9M7.5 11.25h9m-9 4.5h6"/>
                                <path fill-rule="evenodd" d="M5.25 3.75A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25Z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-700">Word Counter</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Count words, characters, sentences and reading time instantly.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/tools/password-generator') }}" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-50/30">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-100 text-violet-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.5 10.5V7.875a4.5 4.5 0 1 0-9 0V10.5m-.75 0h10.5A1.5 1.5 0 0 1 18.75 12v6A1.5 1.5 0 0 1 17.25 19.5H6.75A1.5 1.5 0 0 1 5.25 18v-6A1.5 1.5 0 0 1 6.75 10.5Z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-700">Password Generator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Generate strong random passwords for websites and apps.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/tools/json-formatter') }}" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-50/30">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8.25 6.75c-1.657 0-3 1.343-3 3v.75c0 .414-.336.75-.75.75H3m5.25 6c-1.657 0-3-1.343-3-3v-.75c0-.414-.336-.75-.75-.75H3m12.75-6c1.657 0 3 1.343 3 3v.75c0 .414.336.75.75.75H21m-5.25 6c1.657 0 3-1.343 3-3v-.75c0-.414.336-.75.75-.75H21"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-700">JSON Formatter</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Format, validate and minify JSON data online.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/tools/resume-builder') }}" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-50/30">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-rose-100 text-rose-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.5 3.75A2.25 2.25 0 0 0 5.25 6v12A2.25 2.25 0 0 0 7.5 20.25h9A2.25 2.25 0 0 0 18.75 18V8.56a2.25 2.25 0 0 0-.659-1.591l-2.81-2.81A2.25 2.25 0 0 0 13.69 3.5H7.5Z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-700">Resume Builder</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Build a clean ATS-friendly resume with live preview.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/tools/cv-builder') }}" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-50/30">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-fuchsia-100 text-fuchsia-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6 5.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V5.25Zm1.5 1.5v11.25h9V6.75h-9Zm11.25-3h-10.5A2.25 2.25 0 0 0 4.5 6.75v13.5A2.25 2.25 0 0 0 6.75 22.5h10.5A2.25 2.25 0 0 0 19.5 20.25V6.75A2.25 2.25 0 0 0 17.25 3.75Z"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-700">CV Builder</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Create a professional CV online with modern templates and PDF download.</p>
                        </div>
                    </div>
                </a>

                <a href="{{ url('/tools/invoice-generator') }}" class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-50/30">
                    <div class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.75 5.25A2.25 2.25 0 0 1 6 3h12a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 18 21H6a2.25 2.25 0 0 1-2.25-2.25V5.25ZM6 4.5a.75.75 0 0 0-.75.75v2.25h13.5V5.25A.75.75 0 0 0 18 4.5H6Zm1.5 6.75a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1-.75-.75Zm0 3.75a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5A.75.75 0 0 1 7.5 15Z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-700">Invoice Generator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Create professional invoices with automatic totals.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    @php
        $latestUpdates = $latestUpdates->map(function ($update) {
            return [
                'title' => $update->title,
                'description' => $update->excerpt,
                'label' => $update->update_type ?? 'Update',
                'date' => $update->published_at ? $update->published_at->diffForHumans() : 'Recent',
                'link' => $update->link,
            ];
        });
    @endphp

    <!-- Latest Updates -->
    <section class="bg-gradient-to-br from-sky-100 via-blue-50 to-indigo-100 border-t border-blue-200 py-10 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-7">
                <p class="text-base font-semibold uppercase tracking-[0.24em] text-blue-700">Latest Updates</p>
            </div>

            <div class="overflow-x-auto pb-4 sm:pb-0">
                <div class="grid min-w-[100%] gap-6 grid-flow-col auto-cols-[minmax(300px,1fr)] md:grid-flow-row md:grid-cols-3">
                    @foreach($latestUpdates as $update)
                        <article data-update-id="{{ md5($update['title']) }}" class="update-card group relative overflow-hidden rounded-3xl border-2 border-blue-100/80 bg-gradient-to-br from-white via-blue-50/30 to-white p-6 shadow-[0_20px_60px_-20px_rgba(59,130,246,0.2)] transition-all duration-500 hover:-translate-y-2 hover:border-blue-300 hover:shadow-[0_40px_100px_-30px_rgba(59,130,246,0.35)]">
                            <div class="absolute inset-0 bg-gradient-to-br from-sky-100/20 to-transparent pointer-events-none"></div>
                            <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-sky-300/20 via-blue-200/10 to-transparent opacity-0 transition duration-500 group-hover:opacity-100"></div>
                            <div class="relative flex items-start justify-between gap-4">
                                <div class="flex flex-wrap items-center gap-2">
                                    @if(!empty($update['label']))
                                        <span class="inline-flex rounded-full bg-blue-100 px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.2em] text-blue-700">{{ $update['label'] }}</span>
                                    @endif
                                    <span class="relative inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-amber-300 via-amber-400 to-yellow-300 px-3 py-1.5 text-[12px] font-bold uppercase tracking-[0.2em] text-slate-900 shadow-[0_0_20px_rgba(249,115,22,0.4)] animate-twinkle update-new-badge">
                                        <span class="absolute -inset-1 rounded-full bg-amber-400/20 blur-lg -z-10"></span>
                                        <span class="text-base leading-none">★</span>
                                        New
                                    </span>
                                </div>
                                <span class="text-xs font-semibold text-blue-600 bg-blue-100/60 rounded-lg px-2 py-1">{{ $update['date'] }}</span>
                            </div>
                            <h3 class="relative mt-5 text-lg font-bold text-slate-900 group-hover:text-blue-700 transition">{{ $update['title'] }}</h3>
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $update['description'] }}</p>
                            @if(!empty($update['link']))
                                <a href="{{ $update['link'] }}" class="update-card-link mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-[0_10px_25px_-8px_rgba(37,99,235,0.3)] transition-all duration-300 hover:shadow-[0_15px_35px_-10px_rgba(37,99,235,0.5)] hover:scale-105 active:scale-95">
                                    View update
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M13.28 4.22a.75.75 0 0 1 1.06 0l5.44 5.44a.75.75 0 0 1 0 1.06l-5.44 5.44a.75.75 0 0 1-1.06-1.06L17.44 11H4.75a.75.75 0 0 1 0-1.5h12.69l-4.16-4.16a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                const openedUpdates = JSON.parse(localStorage.getItem('toolnova_updates_opened') || '[]');
                document.querySelectorAll('.update-card').forEach(card => {
                    const id = card.dataset.updateId;
                    if (!id || openedUpdates.includes(id)) {
                        const badge = card.querySelector('.update-new-badge');
                        if (badge) badge.remove();
                    }
                });

                document.querySelectorAll('.update-card-link').forEach(link => {
                    link.addEventListener('click', function () {
                        const card = this.closest('.update-card');
                        if (!card) return;
                        const id = card.dataset.updateId;
                        if (!id) return;
                        const stored = JSON.parse(localStorage.getItem('toolnova_updates_opened') || '[]');
                        if (!stored.includes(id)) {
                            stored.push(id);
                            localStorage.setItem('toolnova_updates_opened', JSON.stringify(stored));
                        }
                    });
                });
            } catch (error) {
                console.warn('ToolNova update badge script error:', error);
            }
        });
    </script>

    <style>
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            25% {
                background-position: 50% 0%;
            }
            50% {
                background-position: 100% 50%;
            }
            75% {
                background-position: 50% 100%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes twinkle {
            0%, 100% {
                transform: scale(1) rotate(0deg);
                filter: brightness(1) drop-shadow(0 0 8px rgba(249, 115, 22, 0.4));
            }
            25% {
                transform: scale(1.08) rotate(5deg);
                filter: brightness(1.1) drop-shadow(0 0 12px rgba(249, 115, 22, 0.6));
            }
            50% {
                transform: scale(1.12) rotate(-2deg);
                filter: brightness(1.15) drop-shadow(0 0 16px rgba(251, 191, 36, 0.8));
            }
            75% {
                transform: scale(1.08) rotate(3deg);
                filter: brightness(1.1) drop-shadow(0 0 12px rgba(249, 115, 22, 0.6));
            }
        }

        .animate-gradient-text {
            background-size: 300% 300%;
            animation: gradientShift 12s ease-in-out infinite;
            text-shadow: 0 0 24px rgba(56,189,248,0.18);
        }

        .animate-twinkle {
            animation: twinkle 1.8s ease-in-out infinite;
        }
    </style>

    <!-- Need Help -->
    <section class="bg-white py-12 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200 bg-gradient-to-br from-blue-50 to-slate-50 p-6 shadow-sm sm:p-8">
                <div class="flex flex-col gap-4 sm:items-center sm:justify-between sm:flex-row">
                    <div class="max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-blue-600">Need Help?</p>
                        <h2 class="mt-2 text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">Need help using a tool, found an issue, or have a suggestion?</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-600">Reach out and we'll be happy to help.</p>
                    </div>

                    <div class="grid gap-2 sm:auto-cols-min sm:grid-flow-col">
                        <a href="{{ url('/contact') }}" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-blue-700 hover:shadow-md">Contact Us</a>
                        <a href="https://wa.me/255698751800?text=Hi%20I%20need%20help%20with%20ToolNova" class="inline-flex items-center justify-center rounded-lg border border-blue-600 bg-white px-4 py-2 text-xs font-semibold text-blue-600 transition hover:bg-blue-50 hover:border-blue-700">WhatsApp Support</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection