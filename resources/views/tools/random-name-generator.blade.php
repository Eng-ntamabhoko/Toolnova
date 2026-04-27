@extends('layouts.app')

@section('title', 'Random Name Generator - ToolNova')
@section('meta_description', 'Generate random names online for characters, usernames, brands and creative projects with ToolNova Random Name Generator.')

@section('content')
<div x-data="randomNameGenerator()" data-tool-slug="random-name-generator" class="bg-slate-50 overflow-x-hidden">

    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-medium text-blue-200 sm:text-sm">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Random Name Generator
                </h1>

                <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Generate random names for characters, brands, usernames, stories and creative projects in seconds.
                </p>
            </div>
        </div>
    </section>

    <section class="py-6 sm:py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:grid lg:grid-cols-12 lg:gap-8">

                <!-- Controls -->
                <aside class="w-full lg:col-span-5">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Name Settings</h2>
                            <p class="mt-1 text-sm text-slate-500">Choose a category and number of names.</p>
                        </div>

                        <div class="mt-6 space-y-4">
                            <div>
                                <label for="category" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Name Category
                                </label>
                                <select
                                    id="category"
                                    x-model="category"
                                    class="block w-full min-w-0 rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                                    <option value="male">Male Names</option>
                                    <option value="female">Female Names</option>
                                    <option value="unisex">Unisex Names</option>
                                    <option value="fantasy">Fantasy Names</option>
                                    <option value="brand">Brand Names</option>
                                </select>
                            </div>

                            <div>
                                <label for="count" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Number of Names
                                </label>
                                <input
                                    id="count"
                                    type="number"
                                    min="1"
                                    max="30"
                                    x-model="count"
                                    class="block w-full min-w-0 rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <button
                                type="button"
                                @click="generateNames()"
                                class="w-full rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                            >
                                Generate Names
                            </button>

                            <button
                                type="button"
                                @click="copyNames()"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                            >
                                <span x-text="copied ? 'Copied' : 'Copy Names'"></span>
                            </button>

                            <button
                                type="button"
                                @click="clearAll()"
                                class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
                            >
                                Clear
                            </button>

                            <button
                                type="button"
                                @click="shareTool()"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                            >
                                Share Tool
                            </button>
                        </div>
                    </div>
                </aside>

                <!-- Results -->
                <div class="w-full space-y-6 lg:col-span-7">

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Generated Names</h2>
                            <p class="mt-1 text-sm text-slate-500">Fresh name ideas based on your selected category.</p>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">
                            <template x-if="names.length === 0">
                                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
                                    Generated names will appear here.
                                </div>
                            </template>

                            <template x-for="(name, index) in names" :key="index">
                                <div class="rounded-2xl bg-slate-50 p-4 text-center">
                                    <p class="text-lg font-bold text-slate-900" x-text="name"></p>
                                </div>
                            </template>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            This random name generator helps writers, gamers, creators, entrepreneurs and anyone who needs quick inspiration
                            for characters, brands, usernames or creative ideas.
                        </p>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <button
                            type="button"
                            @click="openHowTo = !openHowTo"
                            class="flex w-full items-center justify-between gap-4 text-left"
                        >
                            <div class="min-w-0">
                                <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">How to Use</h2>
                                <p class="mt-1 text-sm text-slate-500">Click to view the steps.</p>
                            </div>

                            <div class="shrink-0 rounded-2xl bg-slate-100 p-3 text-slate-700">
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
                                <li><strong class="text-slate-900">1.</strong> Select the name category you want.</li>
                                <li><strong class="text-slate-900">2.</strong> Choose how many names to generate.</li>
                                <li><strong class="text-slate-900">3.</strong> Click Generate Names to refresh the list.</li>
                                <li><strong class="text-slate-900">4.</strong> Copy the names you like for your project.</li>
                            </ol>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Frequently Asked Questions</h2>
                            <p class="mt-1 text-sm text-slate-500">Tap a question to view the answer.</p>
                        </div>

                        <div class="mt-6 space-y-4">
                            <template x-for="(item, index) in faqItems" :key="index">
                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <button
                                        type="button"
                                        @click="toggleFaq(index)"
                                        class="flex w-full items-center justify-between gap-4 bg-white px-4 py-4 text-left sm:px-5"
                                    >
                                        <span class="pr-2 font-semibold text-slate-900" x-text="item.q"></span>

                                        <span class="shrink-0 rounded-full bg-slate-100 p-2 text-slate-700">
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
                                <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Related Creative and Utility Tools</h2>
                                <p class="mt-1 text-sm text-slate-500">
                                    Explore more useful tools for writing, branding and content creation.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/text-case-converter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Text Case Converter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Convert text into uppercase, lowercase and more.</p>
                            </a>

                            <a href="{{ url('/tools/word-counter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Word Counter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Count words, characters and reading time instantly.</p>
                            </a>

                            <a href="{{ url('/tools/base64-encoder-decoder') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Base64 Encoder / Decoder</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Encode and decode Base64 text online.</p>
                            </a>
                        </div>

                        <div class="mt-10 grid gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">When a random name generator is useful</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    A random name generator is useful for naming characters, story ideas, brands, startups,
                                    projects, game profiles, usernames and other creative work.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-slate-900">What this tool can generate</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    This tool can generate male names, female names, unisex names, fantasy names
                                    and short brand-style names for different kinds of projects.
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