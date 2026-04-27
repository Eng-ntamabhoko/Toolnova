@extends('layouts.app')

@section('title', 'Discount Calculator - ToolNova')
@section('meta_description', 'Calculate discounts, sale prices, tax and savings online with ToolNova Discount Calculator.')

@section('content')
<div x-data="discountCalculator()" data-tool-slug="discount-calculator" class="bg-slate-50">

    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs sm:text-sm font-medium text-blue-200">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Discount Calculator
                </h1>

                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Calculate discount amount, final sale price, tax after discount and even estimate the original price from a sale price.
                </p>
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="space-y-6 sm:space-y-8">

                <!-- Main calculator -->
                <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Discount and Final Price</h2>
                        <p class="mt-1 text-sm text-slate-500 sm:text-base">Enter the original price, discount and optional tax.</p>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div>
                            <label for="originalPrice" class="mb-2 block text-sm font-semibold text-slate-700">Original Price</label>
                            <input id="originalPrice" type="number" step="any" x-model="originalPrice" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="discountPercent" class="mb-2 block text-sm font-semibold text-slate-700">Discount %</label>
                            <input id="discountPercent" type="number" step="any" x-model="discountPercent" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="taxPercent" class="mb-2 block text-sm font-semibold text-slate-700">Tax % (Optional)</label>
                            <input id="taxPercent" type="number" step="any" x-model="taxPercent" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <div class="rounded-2xl bg-blue-50 p-5">
                            <p class="text-sm font-medium text-blue-700">Discount Amount</p>
                            <p class="mt-2 text-2xl font-bold text-slate-900" x-text="formatNumber(results.discountAmount)"></p>
                        </div>

                        <div class="rounded-2xl bg-emerald-50 p-5">
                            <p class="text-sm font-medium text-emerald-700">Final Price</p>
                            <p class="mt-2 text-2xl font-bold text-slate-900" x-text="formatNumber(results.finalPrice)"></p>
                        </div>

                        <div class="rounded-2xl bg-amber-50 p-5">
                            <p class="text-sm font-medium text-amber-700">Tax Amount</p>
                            <p class="mt-2 text-2xl font-bold text-slate-900" x-text="formatNumber(results.taxAmount)"></p>
                        </div>

                        <div class="rounded-2xl bg-violet-50 p-5">
                            <p class="text-sm font-medium text-violet-700">Final Price + Tax</p>
                            <p class="mt-2 text-2xl font-bold text-slate-900" x-text="formatNumber(results.finalPriceWithTax)"></p>
                        </div>
                    </div>
                </section>

                <!-- Reverse calculator -->
                <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Find Original Price from Sale Price</h2>
                        <p class="mt-1 text-sm text-slate-500 sm:text-base">Estimate the original price before the discount was applied.</p>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div>
                            <label for="salePrice" class="mb-2 block text-sm font-semibold text-slate-700">Sale Price</label>
                            <input id="salePrice" type="number" step="any" x-model="salePrice" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="reverseDiscountPercent" class="mb-2 block text-sm font-semibold text-slate-700">Discount %</label>
                            <input id="reverseDiscountPercent" type="number" step="any" x-model="reverseDiscountPercent" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>

                        <div class="rounded-2xl bg-pink-50 p-5">
                            <p class="text-sm font-medium text-pink-700">Estimated Original Price</p>
                            <p class="mt-2 text-2xl font-bold text-slate-900" x-text="formatNumber(results.originalFromSale)"></p>
                        </div>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <button
                            type="button"
                            @click="clearAll()"
                            class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700 sm:w-auto"
                        >
                            Clear All
                        </button>

                        <button
                            type="button"
                            @click="shareTool()"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 sm:w-auto"
                        >
                            Share Tool
                        </button>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                    <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                    <p class="mt-4 leading-7 text-slate-600">
                        This discount calculator helps shoppers, business owners and sellers quickly estimate savings,
                        compare offers, calculate final cost after discounts and understand the real value of a promotion.
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
                            <li><strong class="text-slate-900">1.</strong> Enter the original price of the item.</li>
                            <li><strong class="text-slate-900">2.</strong> Enter the discount percentage.</li>
                            <li><strong class="text-slate-900">3.</strong> Add tax percentage if needed.</li>
                            <li><strong class="text-slate-900">4.</strong> Review the discount amount, final price and total after tax.</li>
                            <li><strong class="text-slate-900">5.</strong> Use the reverse calculator if you only know the sale price.</li>
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
                            <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Related Money and Math Tools</h2>
                            <p class="mt-1 text-sm text-slate-500 sm:text-base">
                                Explore more useful tools for calculations, shopping and pricing.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        <a href="{{ url('/tools/percentage-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Percentage Calculator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Calculate percentages, increase and decrease quickly.</p>
                        </a>

                        <a href="{{ url('/tools/loan-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Loan Calculator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Estimate monthly payments and total repayment.</p>
                        </a>

                        <a href="{{ url('/tools/invoice-generator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Invoice Generator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Create invoices for products and services online.</p>
                        </a>
                    </div>

                    <div class="mt-10 grid gap-8 lg:grid-cols-2">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">When a discount calculator is useful</h3>
                            <p class="mt-3 leading-7 text-slate-600">
                                A discount calculator is useful during shopping, business promotions, sales analysis,
                                pricing strategy, retail comparisons and budgeting before making a purchase.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-slate-900">What this tool can calculate</h3>
                            <p class="mt-3 leading-7 text-slate-600">
                                This tool can calculate discount value, final selling price, tax after discount
                                and even work backward from a sale price to estimate the original price.
                            </p>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </section>
</div>
@endsection