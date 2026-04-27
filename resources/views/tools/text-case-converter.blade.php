@extends('layouts.app')

@section('title', 'Text Case Converter - ToolNova')
@section('meta_description', 'Convert text into uppercase, lowercase, title case and sentence case online with ToolNova Text Case Converter.')

@section('content')
<div x-data="textCaseConverter()" data-tool-slug="text-case-converter" class="bg-slate-50">

    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs sm:text-sm font-medium text-blue-200">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Text Case Converter
                </h1>

                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Convert text into uppercase, lowercase, title case, sentence case and more for writing, editing and content work.
                </p>
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-12 lg:gap-8">

                <!-- Input -->
                <aside class="lg:col-span-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex items-start gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 sm:h-12 sm:w-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 6.75h9M7.5 12h9m-9 5.25h6" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 3.75h13.5A2.25 2.25 0 0 1 21 6v12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18V6a2.25 2.25 0 0 1 2.25-2.25Z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h2 class="text-lg font-bold text-slate-900 sm:text-xl">Input Text</h2>
                                <p class="text-sm text-slate-500">Paste or type the text you want to convert.</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="inputText" class="mb-2 block text-sm font-semibold text-slate-700">
                                Original Text
                            </label>
                            <textarea
                                id="inputText"
                                x-model="inputText"
                                rows="12"
                                placeholder="Type or paste your text here..."
                                class="w-full rounded-2xl border border-slate-300 px-4 py-4 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            ></textarea>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3 xl:grid-cols-3">
                            <button type="button" @click="toUppercase()" class="rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                                UPPERCASE
                            </button>

                            <button type="button" @click="toLowercase()" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                lowercase
                            </button>

                            <button type="button" @click="toTitleCase()" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                Title Case
                            </button>

                            <button type="button" @click="toSentenceCase()" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                Sentence case
                            </button>

                            <button type="button" @click="toCapitalizeEachWord()" class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                                Capitalize Words
                            </button>

                            <button type="button" @click="clearAll()" class="rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                                Clear
                            </button>
                        </div>

                        <div class="mt-5 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-medium text-slate-500">Input Words</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="inputWords"></p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-medium text-slate-500">Input Characters</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="inputCharacters"></p>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Output -->
                <div class="lg:col-span-6 space-y-6 sm:space-y-8">

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Converted Output</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">Your transformed text will appear here.</p>
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row">
                                <button
                                    type="button"
                                    @click="copyOutput()"
                                    class="rounded-2xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    <span x-text="copied ? 'Copied' : 'Copy Output'"></span>
                                </button>

                                <button
                                    type="button"
                                    @click="shareTool()"
                                    class="rounded-2xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-600"
                                >
                                    Share Tool
                                </button>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:p-5">
                            <textarea
                                rows="12"
                                readonly
                                :value="outputText"
                                placeholder="Converted text will appear here..."
                                class="w-full resize-none bg-transparent text-slate-800 outline-none"
                            ></textarea>
                        </div>

                        <div class="mt-5 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-medium text-slate-500">Output Words</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="outputWords"></p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4">
                                <p class="text-sm font-medium text-slate-500">Output Characters</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="outputCharacters"></p>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            This text case converter helps writers, students, marketers and editors quickly change text style
                            for headings, captions, documents, assignments, social posts and formatted content.
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
                                <li><strong class="text-slate-900">1.</strong> Type or paste your text into the input area.</li>
                                <li><strong class="text-slate-900">2.</strong> Choose the text case format you want.</li>
                                <li><strong class="text-slate-900">3.</strong> Review the converted output instantly.</li>
                                <li><strong class="text-slate-900">4.</strong> Copy the result when ready.</li>
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
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Related Writing and Utility Tools</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">
                                    Explore more useful tools for text, formatting and productivity.
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

                            <a href="{{ url('/tools/json-formatter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">JSON Formatter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Format and validate JSON with smart error details.</p>
                            </a>
                        </div>

                        <div class="mt-10 grid gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">When a text case converter is useful</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    A text case converter is useful for editing titles, headings, assignments, captions, product descriptions,
                                    emails and content that needs consistent formatting quickly.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-slate-900">What this tool can do</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    This tool can convert text into uppercase, lowercase, title case, sentence case and word capitalization
                                    while also helping users review text length before copying the result.
                                </p>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection