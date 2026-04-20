@extends('layouts.app')

@section('title', 'Percentage Calculator - ToolNova')
@section('meta_description', 'Calculate percentages, percentage increase and percentage decrease online with ToolNova Percentage Calculator.')

@section('content')
<div x-data="percentageCalculator()" data-tool-slug="percentage-calculator" class="bg-slate-50">

    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs sm:text-sm font-medium text-blue-200">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Percentage Calculator
                </h1>

                <p class="mt-4 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Calculate percentages, find what percent one number is of another, and check percentage increase or decrease instantly.
                </p>
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="space-y-6 sm:space-y-8">

                <!-- Section 1 -->
                <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">What is X% of Y?</h2>
                            <p class="mt-1 text-sm text-slate-500 sm:text-base">Find a percentage of any number.</p>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div>
                            <label for="valueA" class="mb-2 block text-sm font-semibold text-slate-700">Percentage</label>
                            <input id="valueA" type="number" step="any" x-model="valueA" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="valueB" class="mb-2 block text-sm font-semibold text-slate-700">Of Number</label>
                            <input id="valueB" type="number" step="any" x-model="valueB" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>

                        <div class="rounded-2xl bg-blue-50 p-5">
                            <p class="text-sm font-medium text-blue-700">Result</p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="formatNumber(results.percentOf)"></p>
                        </div>
                    </div>
                </section>

                <!-- Section 2 -->
                <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                    <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">X is what percent of Y?</h2>
                    <p class="mt-1 text-sm text-slate-500 sm:text-base">Compare one number with another as a percentage.</p>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div>
                            <label for="partValue" class="mb-2 block text-sm font-semibold text-slate-700">Value X</label>
                            <input id="partValue" type="number" step="any" x-model="partValue" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>

                        <div>
                            <label for="baseValue" class="mb-2 block text-sm font-semibold text-slate-700">Value Y</label>
                            <input id="baseValue" type="number" step="any" x-model="baseValue" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                        </div>

                        <div class="rounded-2xl bg-emerald-50 p-5">
                            <p class="text-sm font-medium text-emerald-700">Result</p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-900">
                                <span x-text="results.whatPercent !== null ? `${formatNumber(results.whatPercent)}%` : '--'"></span>
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Section 3 -->
                <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Percentage Increase</h2>
                        <p class="mt-1 text-sm text-slate-500 sm:text-base">Find how much a value has increased in percentage terms.</p>

                        <div class="mt-6 grid gap-4">
                            <div>
                                <label for="oldValue" class="mb-2 block text-sm font-semibold text-slate-700">Old Value</label>
                                <input id="oldValue" type="number" step="any" x-model="oldValue" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                            </div>

                            <div>
                                <label for="newValue" class="mb-2 block text-sm font-semibold text-slate-700">New Value</label>
                                <input id="newValue" type="number" step="any" x-model="newValue" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                            </div>

                            <div class="rounded-2xl bg-amber-50 p-5">
                                <p class="text-sm font-medium text-amber-700">Increase</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900">
                                    <span x-text="results.increasePercent !== null ? `${formatNumber(results.increasePercent)}%` : '--'"></span>
                                </p>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Percentage Decrease</h2>
                        <p class="mt-1 text-sm text-slate-500 sm:text-base">Find how much a value has decreased in percentage terms.</p>

                        <div class="mt-6 grid gap-4">
                            <div>
                                <label for="oldDecreaseValue" class="mb-2 block text-sm font-semibold text-slate-700">Old Value</label>
                                <input id="oldDecreaseValue" type="number" step="any" x-model="oldDecreaseValue" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                            </div>

                            <div>
                                <label for="newDecreaseValue" class="mb-2 block text-sm font-semibold text-slate-700">New Value</label>
                                <input id="newDecreaseValue" type="number" step="any" x-model="newDecreaseValue" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                            </div>

                            <div class="rounded-2xl bg-violet-50 p-5">
                                <p class="text-sm font-medium text-violet-700">Decrease</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900">
                                    <span x-text="results.decreasePercent !== null ? `${formatNumber(results.decreasePercent)}%` : '--'"></span>
                                </p>
                            </div>
                        </div>
                    </section>
                </div>

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
                        This percentage calculator helps with discounts, exam results, growth rates, business comparisons,
                        budgeting, profit checks, shopping decisions and many everyday number calculations.
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
                            <li><strong class="text-slate-900">1.</strong> Choose the type of percentage calculation you need.</li>
                            <li><strong class="text-slate-900">2.</strong> Enter the values into the relevant fields.</li>
                            <li><strong class="text-slate-900">3.</strong> View the result instantly as you type.</li>
                            <li><strong class="text-slate-900">4.</strong> Clear the fields to start another calculation.</li>
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
                            <h2 class="text-xl font-bold text-slate-900 sm:text-2xl">Related Math and Utility Tools</h2>
                            <p class="mt-1 text-sm text-slate-500 sm:text-base">
                                Explore more useful tools for calculations, text and productivity.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        <a href="{{ url('/tools/age-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Age Calculator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Calculate exact age with useful date insights.</p>
                        </a>

                        <a href="{{ url('/tools/loan-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Loan Calculator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Estimate loan payments and repayment details.</p>
                        </a>

                        <a href="{{ url('/tools/discount-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Discount Calculator</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Calculate sale price and savings quickly.</p>
                        </a>
                    </div>

                    <div class="mt-10 grid gap-8 lg:grid-cols-2">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">When a percentage calculator is useful</h3>
                            <p class="mt-3 leading-7 text-slate-600">
                                A percentage calculator is useful for shopping discounts, exam marks, salary comparisons,
                                business reports, budgeting, savings calculations and many quick everyday decisions.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-slate-900">What this tool can calculate</h3>
                            <p class="mt-3 leading-7 text-slate-600">
                                This tool can find a percentage of a number, tell what percent one value is of another,
                                and calculate both percentage increase and percentage decrease in one place.
                            </p>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </section>
</div>
@endsection