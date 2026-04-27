@extends('layouts.app')

@section('title', 'Base64 Encoder / Decoder - ToolNova')
@section('meta_description', 'Encode text to Base64 or decode Base64 to text online with ToolNova Base64 Encoder / Decoder.')

@section('content')
<div x-data="base64Tool()" data-tool-slug="base64-encoder-decoder" class="bg-slate-50">

    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs sm:text-sm font-medium text-blue-200">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Base64 Encoder / Decoder
                </h1>

                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Encode text into Base64 or decode Base64 back into readable text quickly for development, testing and data handling.
                </p>
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-12 lg:gap-8">

                <!-- Input -->
                <aside class="lg:col-span-5">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Conversion Settings</h2>
                            <p class="mt-1 text-sm text-slate-500 sm:text-base">Choose encode or decode and enter your text.</p>
                        </div>

                        <div class="mt-6 space-y-5">
                            <div>
                                <label for="mode" class="mb-2 block text-sm font-semibold text-slate-700">Mode</label>
                                <select
                                    id="mode"
                                    x-model="mode"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                                    <option value="encode">Encode to Base64</option>
                                    <option value="decode">Decode from Base64</option>
                                </select>
                            </div>

                            <div>
                                <label for="inputText" class="mb-2 block text-sm font-semibold text-slate-700">
                                    <span x-text="mode === 'encode' ? 'Text Input' : 'Base64 Input'"></span>
                                </label>
                                <textarea
                                    id="inputText"
                                    x-model="inputText"
                                    rows="12"
                                    :placeholder="mode === 'encode' ? 'Type or paste text here...' : 'Paste Base64 value here...'"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-4 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                ></textarea>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-3">
                                <button
                                    type="button"
                                    @click="swapMode()"
                                    class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    Swap
                                </button>

                                <button
                                    type="button"
                                    @click="clearAll()"
                                    class="rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
                                >
                                    Clear
                                </button>

                                <button
                                    type="button"
                                    @click="shareTool()"
                                    class="rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    Share
                                </button>
                            </div>

                            <div
                                x-show="error"
                                x-transition
                                class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                            >
                                <span x-text="error"></span>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-sm font-medium text-slate-500">Input Characters</p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900" x-text="inputCharacters"></p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-sm font-medium text-slate-500">Output Characters</p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900" x-text="outputCharacters"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Output -->
                <div class="lg:col-span-7 space-y-6 sm:space-y-8">

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Converted Output</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">Your converted result appears here instantly.</p>
                            </div>

                            <button
                                type="button"
                                @click="copyOutput()"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:w-auto"
                            >
                                <span x-text="copied ? 'Copied' : 'Copy Output'"></span>
                            </button>
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:p-5">
                            <textarea
                                rows="12"
                                readonly
                                :value="outputText"
                                :placeholder="mode === 'encode' ? 'Base64 output will appear here...' : 'Decoded text will appear here...'"
                                class="w-full resize-none bg-transparent outline-none"
                            ></textarea>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            This Base64 encoder and decoder helps with development tasks, API testing, encoded strings,
                            text transformations and quick troubleshooting when working with data in web and software projects.
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
                                <li><strong class="text-slate-900">1.</strong> Choose whether you want to encode or decode.</li>
                                <li><strong class="text-slate-900">2.</strong> Paste your text or Base64 value into the input field.</li>
                                <li><strong class="text-slate-900">3.</strong> View the converted result instantly.</li>
                                <li><strong class="text-slate-900">4.</strong> Copy the output or switch mode when needed.</li>
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
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Related Developer and Utility Tools</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">
                                    Explore more useful tools for text, coding and productivity.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/json-formatter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">JSON Formatter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Format and validate JSON with smart insights.</p>
                            </a>

                            <a href="{{ url('/tools/text-case-converter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Text Case Converter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Convert text into uppercase, lowercase and more.</p>
                            </a>

                            <a href="{{ url('/tools/word-counter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Word Counter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Count words, characters and reading time instantly.</p>
                            </a>
                        </div>

                        <div class="mt-10 grid gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">When a Base64 tool is useful</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    A Base64 tool is useful when testing APIs, working with encoded strings,
                                    preparing data for transfer or quickly decoding values during development and debugging.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-slate-900">What this tool can do</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    This tool can encode readable text into Base64 and decode Base64 back into text
                                    with quick output, character counts and simple error handling.
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