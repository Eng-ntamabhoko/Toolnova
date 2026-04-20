@extends('layouts.app')

@section('title', 'QR Code Generator - ToolNova')
@section('meta_description', 'Generate QR codes online for links, text and contact details with ToolNova QR Code Generator.')

@section('content')
<div x-data="qrCodeGenerator()" data-tool-slug="qr-code-generator" class="bg-slate-50">

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
                    QR Code Generator
                </h1>

                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Create QR codes for links, text and other content instantly. Customize colors, preview live and download as PNG.
                </p>
            </div>
        </div>
    </section>

    <!-- Tool Area -->
    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-12 lg:gap-8">

                <!-- Controls -->
                <aside class="lg:col-span-5">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex items-start gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 sm:h-12 sm:w-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5h6v6h-6v-6Zm9 0h6v6h-6v-6Zm-9 9h6v6h-6v-6Zm10.5 0h1.5m-1.5 3h3m-3 3h1.5m3-6v6" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h2 class="text-lg font-bold text-slate-900 sm:text-xl">QR settings</h2>
                                <p class="text-sm text-slate-500">Enter content and customize the design.</p>
                            </div>
                        </div>

                        <div class="mt-6 space-y-5">
                            <div>
                                <label for="qrText" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Text or Link
                                </label>
                                <textarea
                                    id="qrText"
                                    x-model="text"
                                    rows="6"
                                    placeholder="Enter website URL, text, phone number or other content..."
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-4 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                ></textarea>
                            </div>

                            <div>
                                <div class="mb-2 flex items-center justify-between">
                                    <label for="size" class="text-sm font-semibold text-slate-700">QR Size</label>
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700" x-text="`${size}px`"></span>
                                </div>
                                <input
                                    id="size"
                                    type="range"
                                    min="128"
                                    max="512"
                                    step="32"
                                    x-model="size"
                                    class="w-full"
                                >
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="darkColor" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Dark Color
                                    </label>
                                    <input
                                        id="darkColor"
                                        type="color"
                                        x-model="darkColor"
                                        class="h-12 w-full rounded-2xl border border-slate-300 bg-white p-2"
                                    >
                                </div>

                                <div>
                                    <label for="lightColor" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Light Color
                                    </label>
                                    <input
                                        id="lightColor"
                                        type="color"
                                        x-model="lightColor"
                                        class="h-12 w-full rounded-2xl border border-slate-300 bg-white p-2"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <button
                                    type="button"
                                    @click="generateQrCode()"
                                    class="rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                                >
                                    Generate
                                </button>

                                <button
                                    type="button"
                                    @click="clearAll()"
                                    class="rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
                                >
                                    Clear
                                </button>
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                                <button
                                    type="button"
                                    @click="copyText()"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:w-auto"
                                >
                                    <span x-text="copied ? 'Copied' : 'Copy Text'"></span>
                                </button>

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
                                class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                            >
                                <span x-text="error"></span>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Preview -->
                <div class="lg:col-span-7 space-y-6 sm:space-y-8">

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">QR Preview</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">Preview and download your generated QR code.</p>
                            </div>

                            <button
                                type="button"
                                @click="downloadQr()"
                                :disabled="!qrDataUrl"
                                class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-600 disabled:cursor-not-allowed disabled:opacity-50 sm:w-auto"
                            >
                                Download PNG
                            </button>
                        </div>

                        <div class="mt-6 flex min-h-[320px] items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 p-6">
                            <template x-if="qrDataUrl">
                                <img
                                    :src="qrDataUrl"
                                    alt="Generated QR Code"
                                    class="max-h-[320px] w-full max-w-[320px] rounded-2xl border border-slate-200 bg-white p-3"
                                >
                            </template>

                            <template x-if="!qrDataUrl">
                                <div class="text-center text-slate-500">
                                    <p class="text-sm sm:text-base">Your QR code preview will appear here.</p>
                                </div>
                            </template>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            This QR code generator helps users quickly convert links, text and other shareable content into QR codes
                            for print, events, promotions, learning materials, menus, business cards and everyday use.
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
                                <li><strong class="text-slate-900">1.</strong> Enter the link or text you want to convert.</li>
                                <li><strong class="text-slate-900">2.</strong> Adjust the QR size and choose the colors you prefer.</li>
                                <li><strong class="text-slate-900">3.</strong> Review the preview on the page.</li>
                                <li><strong class="text-slate-900">4.</strong> Download the QR code as a PNG image when ready.</li>
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
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Related Tools</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">
                                    Explore more useful tools for text, security and productivity.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/password-generator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Password Generator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Generate stronger passwords for accounts and apps.</p>
                            </a>

                            <a href="{{ url('/tools/word-counter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Word Counter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Count words, characters and reading time instantly.</p>
                            </a>

                            <a href="{{ url('/tools/json-formatter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">JSON Formatter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Format and validate JSON with smart error details.</p>
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
    'pageSlug' => 'qr-code-generator',
    'comments' => $comments ?? collect()
])

@endsection