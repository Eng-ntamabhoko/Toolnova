@extends('layouts.app')

@section('title', 'JSON Formatter - ToolNova')
@section('meta_description', 'Format, beautify, validate, sort and minify JSON online with ToolNova JSON Formatter.')

@section('content')
<div x-data="jsonFormatter()" data-tool-slug="json-formatter" class="bg-slate-50">

    <!-- Hero -->
    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs sm:text-sm font-medium text-blue-200">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    JSON Formatter
                </h1>

                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Format, validate, minify and analyze JSON with smart error details, key statistics and structure summary.
                </p>
            </div>
        </div>
    </section>

    <!-- Tool Area -->
    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-12 lg:gap-8">

                <!-- Input -->
                <aside class="lg:col-span-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex items-start gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 sm:h-12 sm:w-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75c-1.657 0-3 1.343-3 3v.75c0 .414-.336.75-.75.75H3m5.25 6c-1.657 0-3-1.343-3-3v-.75c0-.414-.336-.75-.75-.75H3m12.75-6c1.657 0 3 1.343 3 3v.75c0 .414.336.75.75.75H21m-5.25 6c1.657 0 3-1.343 3-3v-.75c0-.414.336-.75.75-.75H21" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h2 class="text-lg font-bold text-slate-900 sm:text-xl">JSON Input</h2>
                                <p class="text-sm text-slate-500">Paste, type or upload JSON.</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="inputJson" class="mb-2 block text-sm font-semibold text-slate-700">
                                Input JSON
                            </label>

                            <textarea
                                id="inputJson"
                                x-model="inputJson"
                                rows="14"
                                placeholder='{"name":"ToolNova","tool":"JSON Formatter"}'
                                class="w-full rounded-2xl border border-slate-300 px-4 py-4 font-mono text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            ></textarea>
                        </div>

                        <div class="mt-5 grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="indentSize" class="mb-2 block text-sm font-semibold text-slate-700">Indentation</label>
                                <select
                                    id="indentSize"
                                    x-model="indentSize"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                                    <option value="2">2 spaces</option>
                                    <option value="4">4 spaces</option>
                                </select>
                            </div>

                            <div class="flex items-end">
                                <label class="flex w-full items-center gap-3 rounded-2xl border border-slate-200 p-4">
                                    <input type="checkbox" x-model="sortKeysEnabled" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                                    <span class="text-sm font-medium text-slate-700">Sort Keys</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3 xl:grid-cols-4">
                            <button
                                type="button"
                                @click="formatJson()"
                                class="rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                            >
                                Format
                            </button>

                            <button
                                type="button"
                                @click="minifyJson()"
                                class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                            >
                                Minify
                            </button>

                            <button
                                type="button"
                                @click="validateJson()"
                                class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                            >
                                Validate
                            </button>

                            <button
                                type="button"
                                @click="clearAll()"
                                class="rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
                            >
                                Clear
                            </button>
                        </div>

                        <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                            <label class="inline-flex w-full cursor-pointer items-center justify-center rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:w-auto">
                                Upload JSON
                                <input type="file" accept=".json,application/json" @change="handleFileUpload" class="hidden">
                            </label>

                            <button
                                type="button"
                                @click="shareTool()"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:w-auto"
                            >
                                Share Tool
                            </button>
                        </div>

                        <div
                            x-show="error"
                            x-transition
                            class="mt-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                        >
                            <p x-text="error"></p>
                            <template x-if="errorLine && errorColumn">
                                <p class="mt-2">
                                    Line: <strong x-text="errorLine"></strong>,
                                    Column: <strong x-text="errorColumn"></strong>
                                </p>
                            </template>
                        </div>

                        <div
                            x-show="validJson === true"
                            x-transition
                            class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
                        >
                            JSON is valid.
                        </div>
                    </div>
                </aside>

                <!-- Output -->
                <div class="lg:col-span-6 space-y-6 sm:space-y-8">

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="min-w-0">
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Output</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">Formatted or minified result.</p>
                            </div>

                            <div class="w-full sm:w-auto">
                                <button
                                    type="button"
                                    @click="copyOutput()"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:w-auto"
                                >
                                    <span x-text="copied ? 'Copied' : 'Copy Output'"></span>
                                </button>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:p-5">
                            <pre class="min-h-[260px] overflow-x-auto whitespace-pre-wrap break-words font-mono text-xs text-slate-800 sm:min-h-[320px] sm:text-sm" x-text="outputJson || 'Formatted or minified JSON will appear here.'"></pre>
                        </div>

                        <div class="mt-4">
                            <button
                                type="button"
                                @click="downloadOutput()"
                                class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-600 sm:w-auto"
                            >
                                Download
                            </button>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">JSON Insights</h2>
                        <p class="mt-1 text-sm text-slate-500 sm:text-base">Useful details about your JSON structure.</p>

                        <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-2 xl:grid-cols-3 sm:gap-4">
                            <div class="rounded-2xl bg-blue-50 p-4 sm:p-5">
                                <p class="text-xs font-medium text-blue-700 sm:text-sm">Total Keys</p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl" x-text="stats.keys"></p>
                            </div>

                            <div class="rounded-2xl bg-emerald-50 p-4 sm:p-5">
                                <p class="text-xs font-medium text-emerald-700 sm:text-sm">Objects</p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl" x-text="stats.objects"></p>
                            </div>

                            <div class="rounded-2xl bg-amber-50 p-4 sm:p-5">
                                <p class="text-xs font-medium text-amber-700 sm:text-sm">Arrays</p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl" x-text="stats.arrays"></p>
                            </div>

                            <div class="rounded-2xl bg-violet-50 p-4 sm:p-5">
                                <p class="text-xs font-medium text-violet-700 sm:text-sm">Max Depth</p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl" x-text="stats.maxDepth"></p>
                            </div>

                            <div class="rounded-2xl bg-pink-50 p-4 sm:p-5">
                                <p class="text-xs font-medium text-pink-700 sm:text-sm">Input Characters</p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl" x-text="stats.characters"></p>
                            </div>

                            <div class="rounded-2xl bg-cyan-50 p-4 sm:p-5">
                                <p class="text-xs font-medium text-cyan-700 sm:text-sm">Output Size</p>
                                <p class="mt-2 text-2xl font-extrabold text-slate-900 sm:text-3xl" x-text="stats.outputSize"></p>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200 p-4 sm:p-5">
                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between sm:gap-4">
                                <h3 class="text-lg font-bold text-slate-900">Structure Summary</h3>
                                <span class="text-sm text-slate-500">Top-level overview</span>
                            </div>

                            <div class="mt-4 space-y-3">
                                <template x-if="structureSummary.length === 0">
                                    <p class="text-sm text-slate-500">Validate or format JSON to view structure summary.</p>
                                </template>

                                <template x-for="item in structureSummary" :key="item.key">
                                    <div class="flex flex-col gap-1 rounded-2xl bg-slate-50 px-4 py-3 sm:flex-row sm:items-center sm:justify-between sm:gap-4">
                                        <span class="font-medium text-slate-900 break-all" x-text="item.key"></span>
                                        <span class="text-sm text-slate-500" x-text="item.type"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            This JSON formatter helps developers, testers and students quickly clean up JSON,
                            check whether it is valid, reduce size with minify mode and understand the structure with built-in analysis.
                        </p>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <button
                            type="button"
                            @click="openHowTo = !openHowTo"
                            class="flex w-full items-center justify-between gap-4 text-left"
                        >
                            <div class="min-w-0">
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">How to Use</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">Click to view the steps.</p>
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
                                <li><strong class="text-slate-900">1.</strong> Paste JSON or upload a JSON file.</li>
                                <li><strong class="text-slate-900">2.</strong> Choose indentation and whether to sort keys.</li>
                                <li><strong class="text-slate-900">3.</strong> Click Format, Minify or Validate.</li>
                                <li><strong class="text-slate-900">4.</strong> Review output, stats and structure summary.</li>
                                <li><strong class="text-slate-900">5.</strong> Copy or download the result if needed.</li>
                            </ol>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Frequently Asked Questions</h2>
                            <p class="mt-1 text-sm text-slate-500 sm:text-base">Tap a question to view the answer.</p>
                        </div>

                        <div class="mt-6 space-y-4">
                            <template x-for="(item, index) in faqItems" :key="index">
                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <button
                                        type="button"
                                        @click="toggleFaq(index)"
                                        class="flex w-full items-center justify-between gap-4 bg-white px-4 py-4 text-left sm:px-5"
                                    >
                                        <span class="font-semibold text-slate-900 pr-2" x-text="item.q"></span>

                                        <span class="rounded-full bg-slate-100 p-2 text-slate-700 shrink-0">
                                            <svg x-show="openFaq !== index" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            <svg x-show="openFaq === index" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </span>
                                    </button>

                                    <div x-show="openFaq === index" x-transition class="border-t border-slate-200 bg-slate-50 px-4 py-4 text-slate-600 sm:px-5">
                                        <p x-text="item.a"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Related Developer and Utility Tools</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">
                                    Explore more useful tools for text, security and everyday online tasks.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/word-counter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Word Counter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Count words, characters and reading time instantly.</p>
                            </a>

                            <a href="{{ url('/tools/password-generator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Password Generator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Generate stronger passwords for accounts and apps.</p>
                            </a>

                            <a href="{{ url('/tools/age-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Age Calculator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Calculate exact age with date insights and milestones.</p>
                            </a>
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
    'pageSlug' => 'json-formatter',
    'comments' => $comments ?? collect()
])

@endsection