@extends('layouts.app')

@section('title', 'Image Compressor - ToolNova')
@section('meta_description', 'Compress images online to reduce file size for websites, uploads and sharing with ToolNova Image Compressor.')

@section('content')
<div x-data="imageCompressor()" data-tool-slug="image-compressor" class="bg-slate-50">

    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs sm:text-sm font-medium text-blue-200">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Image Compressor
                </h1>

                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Compress images online to reduce file size for websites, uploads, email attachments and faster sharing.
                </p>
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-12 lg:gap-8">

                <!-- Controls -->
                <aside class="lg:col-span-5">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex items-start gap-3">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 sm:h-12 sm:w-12">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25A1.5 1.5 0 0 1 5.25 3.75h13.5a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V5.25Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m6.75 15 3-3 2.25 2.25 3.75-4.5 1.5 1.5" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 8.25h.008v.008H8.25V8.25Z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h2 class="text-lg font-bold text-slate-900 sm:text-xl">Compression Settings</h2>
                                <p class="text-sm text-slate-500">Upload an image and adjust the options below.</p>
                            </div>
                        </div>

                        <div class="mt-6 space-y-5">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Upload Image</label>
                                <label class="flex cursor-pointer items-center justify-center rounded-2xl border border-dashed border-slate-300 px-4 py-8 text-center transition hover:bg-slate-50">
                                    <div>
                                        <p class="font-semibold text-slate-700">Choose image file</p>
                                        <p class="mt-1 text-sm text-slate-500">JPG, JPEG, PNG or WebP</p>
                                    </div>
                                    <input type="file" accept="image/*" @change="handleFileUpload" class="hidden">
                                </label>
                            </div>

                            <div>
                                <div class="mb-2 flex items-center justify-between">
                                    <label for="quality" class="text-sm font-semibold text-slate-700">Quality</label>
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700" x-text="`${quality}%`"></span>
                                </div>

                                <input
                                    id="quality"
                                    type="range"
                                    min="20"
                                    max="100"
                                    step="5"
                                    x-model="quality"
                                    class="w-full"
                                >
                            </div>

                            <div>
                                <label for="outputFormat" class="mb-2 block text-sm font-semibold text-slate-700">Output Format</label>
                                <select
                                    id="outputFormat"
                                    x-model="outputFormat"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                                    <option value="jpeg">JPEG</option>
                                    <option value="webp">WebP</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <button
                                    type="button"
                                    @click="compressImage()"
                                    class="rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                                >
                                    Compress
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
                                    @click="downloadCompressed()"
                                    :disabled="!compressedBlob"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 disabled:cursor-not-allowed disabled:opacity-50 sm:w-auto"
                                >
                                    Download Image
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
                                x-show="processing"
                                x-transition
                                class="rounded-2xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-700"
                            >
                                Compressing image...
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
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Preview and Results</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">Compare the original and compressed image.</p>
                            </div>

                            <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                                Live preview
                            </div>
                        </div>

                        <div class="mt-6 grid gap-6 md:grid-cols-2">
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <h3 class="text-sm font-semibold text-slate-700">Original Image</h3>
                                <div class="mt-4 flex min-h-[220px] items-center justify-center overflow-hidden rounded-2xl bg-white p-3">
                                    <template x-if="originalPreview">
                                        <img :src="originalPreview" alt="Original preview" class="max-h-[260px] w-auto rounded-xl object-contain">
                                    </template>
                                    <template x-if="!originalPreview">
                                        <p class="text-sm text-slate-500">Original image preview will appear here.</p>
                                    </template>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <h3 class="text-sm font-semibold text-slate-700">Compressed Image</h3>
                                <div class="mt-4 flex min-h-[220px] items-center justify-center overflow-hidden rounded-2xl bg-white p-3">
                                    <template x-if="compressedPreview">
                                        <img :src="compressedPreview" alt="Compressed preview" class="max-h-[260px] w-auto rounded-xl object-contain">
                                    </template>
                                    <template x-if="!compressedPreview">
                                        <p class="text-sm text-slate-500">Compressed image preview will appear here.</p>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                            <div class="rounded-2xl bg-blue-50 p-5">
                                <p class="text-sm font-medium text-blue-700">Original Size</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="formatBytes(originalSize)"></p>
                            </div>

                            <div class="rounded-2xl bg-emerald-50 p-5">
                                <p class="text-sm font-medium text-emerald-700">Compressed Size</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="formatBytes(compressedSize)"></p>
                            </div>

                            <div class="rounded-2xl bg-amber-50 p-5">
                                <p class="text-sm font-medium text-amber-700">Space Saved</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="`${savedPercent}%`"></p>
                            </div>

                            <div class="rounded-2xl bg-violet-50 p-5">
                                <p class="text-sm font-medium text-violet-700">File Name</p>
                                <p class="mt-2 break-all text-sm font-bold text-slate-900" x-text="originalName || '--'"></p>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            This image compressor helps reduce file size for websites, email attachments, online forms,
                            social sharing and storage without needing complicated software.
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
                                <li><strong class="text-slate-900">1.</strong> Upload the image you want to compress.</li>
                                <li><strong class="text-slate-900">2.</strong> Adjust the quality slider and choose the output format.</li>
                                <li><strong class="text-slate-900">3.</strong> Review the before and after preview.</li>
                                <li><strong class="text-slate-900">4.</strong> Download the compressed image when ready.</li>
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
                                <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Related Tools</h2>
                                <p class="mt-1 text-sm text-slate-500 sm:text-base">
                                    Explore more useful tools for files, text and productivity.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/qr-code-generator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">QR Code Generator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Create QR codes for links and text instantly.</p>
                            </a>

                            <a href="{{ url('/tools/json-formatter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">JSON Formatter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Format and validate JSON with smart insights.</p>
                            </a>

                            <a href="{{ url('/tools/text-case-converter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Text Case Converter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Convert text into uppercase, lowercase and more.</p>
                            </a>
                        </div>

                        <div class="mt-10 grid gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">When an image compressor is useful</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    An image compressor is useful when uploading photos to websites, sending email attachments,
                                    improving page speed or reducing image file size before sharing online.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-slate-900">What this tool can do</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    This tool can compress supported images, show before-and-after previews, estimate savings
                                    and let users download a smaller version quickly from the browser.
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