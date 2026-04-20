@extends('layouts.app')

@section('title', 'Word Counter - ToolNova')
@section('meta_description', 'Count words, characters, sentences, paragraphs, reading time and speaking time instantly with ToolNova Word Counter.')

@section('content')
<div x-data="wordCounter()" data-tool-slug="word-counter" class="bg-slate-50">

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
                    Word Counter
                </h1>

                <p class="mt-4 max-w-2xl text-lg leading-8 text-slate-300">
                    Count words, characters, sentences and paragraphs instantly. Check reading time,
                    speaking time and text details in one place.
                </p>
            </div>
        </div>
    </section>

    <!-- Tool Area -->
    <section class="py-10 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-12">

                <!-- Input Panel -->
                <aside class="lg:col-span-5">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 6.75h9M7.5 12h9m-9 5.25h6" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 3.75h13.5A2.25 2.25 0 0 1 21 6v12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18V6a2.25 2.25 0 0 1 2.25-2.25Z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">Enter text</h2>
                                <p class="text-sm text-slate-500">Type or paste your text below.</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <label for="text" class="mb-2 block text-sm font-semibold text-slate-700">
                                Text Input
                            </label>

                            <textarea
                                id="text"
                                x-model="text"
                                rows="14"
                                placeholder="Type or paste your text here..."
                                class="w-full rounded-2xl border border-slate-300 px-4 py-4 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            ></textarea>
                        </div>

                        <div class="mt-5 grid gap-3 sm:grid-cols-3">
                            <button
                                type="button"
                                @click="copyText()"
                                class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                            >
                                <span x-text="copied ? 'Copied' : 'Copy'"></span>
                            </button>

                            <button
                                type="button"
                                @click="shareText()"
                                class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                            >
                                Share
                            </button>

                            <button
                                type="button"
                                @click="clearText()"
                                class="rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-600"
                            >
                                Clear
                            </button>
                        </div>

                        <div class="mt-5 rounded-2xl bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                            This tool updates automatically while you type, edit or paste text.
                        </div>
                    </div>
                </aside>

                <!-- Results Panel -->
                <div class="lg:col-span-7 space-y-8">

                    <!-- Core Stats -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">Text Summary</h2>
                                <p class="mt-1 text-slate-500">Live count results for your text.</p>
                            </div>

                            <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                                Live analysis
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                            <div class="rounded-2xl bg-blue-50 p-5">
                                <p class="text-sm font-medium text-blue-700">Words</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="words"></p>
                            </div>

                            <div class="rounded-2xl bg-emerald-50 p-5">
                                <p class="text-sm font-medium text-emerald-700">Characters</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="characters"></p>
                            </div>

                            <div class="rounded-2xl bg-amber-50 p-5">
                                <p class="text-sm font-medium text-amber-700">Characters Without Spaces</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="charactersNoSpaces"></p>
                            </div>

                            <div class="rounded-2xl bg-violet-50 p-5">
                                <p class="text-sm font-medium text-violet-700">Sentences</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="sentences"></p>
                            </div>

                            <div class="rounded-2xl bg-pink-50 p-5">
                                <p class="text-sm font-medium text-pink-700">Paragraphs</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="paragraphs"></p>
                            </div>

                            <div class="rounded-2xl bg-cyan-50 p-5">
                                <p class="text-sm font-medium text-cyan-700">Reading Time</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900">
                                    <span x-text="readingTimeMinutes"></span> min
                                </p>
                            </div>
                        </div>
                    </section>

                    <!-- More Insights -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h2 class="text-2xl font-bold text-slate-900">More Text Insights</h2>
                        <p class="mt-1 text-slate-500">Helpful estimates and keyword signals.</p>

                        <div class="mt-8 grid gap-4 md:grid-cols-2">
                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Speaking Time</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900">
                                    <span x-text="speakingTimeMinutes"></span> min
                                </p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Average Words Per Paragraph</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900">
                                    <span x-text="paragraphs > 0 ? (words / paragraphs).toFixed(1) : 0"></span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200 p-5">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-lg font-bold text-slate-900">Top Keywords</h3>
                                <span class="text-sm text-slate-500">Most frequent words</span>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-3">
                                <template x-if="topKeywords.length === 0">
                                    <p class="text-sm text-slate-500">Enter some text to view keyword frequency.</p>
                                </template>

                                <template x-for="item in topKeywords" :key="item.word">
                                    <div class="rounded-full bg-slate-100 px-4 py-2 text-sm text-slate-700">
                                        <span class="font-semibold" x-text="item.word"></span>
                                        <span class="ml-2 text-slate-500" x-text="`(${item.count})`"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </section>

                    <!-- How to Use Accordion -->
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
                                <li><strong class="text-slate-900">1.</strong> Type or paste your text into the input area.</li>
                                <li><strong class="text-slate-900">2.</strong> Watch the counts update instantly while editing.</li>
                                <li><strong class="text-slate-900">3.</strong> Review words, characters, sentences and paragraphs.</li>
                                <li><strong class="text-slate-900">4.</strong> Check estimated reading and speaking time for the text.</li>
                                <li><strong class="text-slate-900">5.</strong> Use copy, share or clear when needed.</li>
                            </ol>
                        </div>
                    </section>

                    <!-- Why Use -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h2 class="text-2xl font-bold text-slate-900">Why Use This Tool</h2>
                        <p class="mt-5 leading-7 text-slate-600">
                            This word counter helps writers, students, marketers and content creators measure text length quickly.
                            It is useful for essays, social media captions, blog posts, product descriptions, assignments and reports.
                        </p>
                    </section>

                    <!-- FAQ Accordion -->
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

                    <!-- SEO Rich Related Content -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">Related Writing and Utility Tools</h2>
                                <p class="mt-1 text-slate-500">
                                    Explore more useful tools for text, formatting and everyday online tasks.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/age-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Age Calculator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Calculate exact age in years, months, days and more with detailed date insights.
                                </p>
                            </a>

                            <a href="{{ url('/tools/password-generator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Password Generator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Create strong and secure passwords for online accounts, business tools and apps.
                                </p>
                            </a>

                            <a href="{{ url('/tools/json-formatter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">JSON Formatter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Format and beautify JSON data quickly for development and debugging work.
                                </p>
                            </a>
                        </div>

                        <div class="mt-10 grid gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">When a word counter is useful</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    A word counter is useful when writing essays, reports, blog posts, product descriptions,
                                    captions, assignments or ad copy. It helps users stay within limits and better understand
                                    the size and structure of their content.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-slate-900">What this tool can show</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    This tool shows word count, character count, sentence count, paragraph count,
                                    characters without spaces, estimated reading time, speaking time and keyword frequency
                                    for a quick overview of your text.
                                </p>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Support Box -->
@include('components.support-box')

<!-- Comments Section -->
@include('components.comments-section', [
    'pageType' => 'tool',
    'pageSlug' => 'word-counter',
    'comments' => $comments ?? collect()
])

@endsection