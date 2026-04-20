@extends('layouts.app')

@section('title', 'Loan Calculator - ToolNova')
@section('meta_description', 'Calculate monthly loan payments, total repayment and interest online with ToolNova Loan Calculator.')

@section('content')
<div x-data="loanCalculator()" data-tool-slug="loan-calculator" class="bg-slate-50 overflow-x-hidden">

    <!-- Hero -->
    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-medium text-blue-200 sm:text-sm">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Loan Calculator
                </h1>

                <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Estimate monthly loan payments, total repayment, total interest and see how extra monthly payments can reduce costs.
                </p>
            </div>
        </div>
    </section>

    <!-- Main -->
    <section class="py-6 sm:py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:grid lg:grid-cols-12 lg:gap-8">

                <!-- Left Panel -->
                <aside class="w-full lg:col-span-5">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Loan Details</h2>
                            <p class="mt-1 text-sm text-slate-500">Enter the details below to estimate repayment.</p>
                        </div>

                        <div class="mt-6 space-y-4">
                            <div>
                                <label for="loanAmount" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Loan Amount
                                </label>
                                <input
                                    id="loanAmount"
                                    type="number"
                                    step="any"
                                    x-model="loanAmount"
                                    class="block w-full min-w-0 rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                            </div>

                            <div>
                                <label for="annualInterestRate" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Annual Interest Rate (%)
                                </label>
                                <input
                                    id="annualInterestRate"
                                    type="number"
                                    step="any"
                                    x-model="annualInterestRate"
                                    class="block w-full min-w-0 rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                            </div>

                            <div>
                                <label for="loanYears" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Loan Term (Years)
                                </label>
                                <input
                                    id="loanYears"
                                    type="number"
                                    step="any"
                                    x-model="loanYears"
                                    class="block w-full min-w-0 rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                            </div>

                            <div>
                                <label for="extraMonthlyPayment" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Extra Monthly Payment (Optional)
                                </label>
                                <input
                                    id="extraMonthlyPayment"
                                    type="number"
                                    step="any"
                                    x-model="extraMonthlyPayment"
                                    class="block w-full min-w-0 rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <button
                                type="button"
                                @click="clearAll()"
                                class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
                            >
                                Clear All
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

                <!-- Right Panel -->
                <div class="w-full space-y-6 lg:col-span-7">

                    <!-- Summary -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Loan Summary</h2>
                            <p class="mt-1 text-sm text-slate-500">Estimated repayment and interest results.</p>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                            <div class="rounded-2xl bg-blue-50 p-4">
                                <p class="text-sm font-medium text-blue-700">Monthly Payment</p>
                                <p class="mt-2 break-words text-xl font-bold text-slate-900 sm:text-2xl" x-text="formatNumber(results.monthlyPayment)"></p>
                            </div>

                            <div class="rounded-2xl bg-emerald-50 p-4">
                                <p class="text-sm font-medium text-emerald-700">Total Payment</p>
                                <p class="mt-2 break-words text-xl font-bold text-slate-900 sm:text-2xl" x-text="formatNumber(results.totalPayment)"></p>
                            </div>

                            <div class="rounded-2xl bg-amber-50 p-4">
                                <p class="text-sm font-medium text-amber-700">Total Interest</p>
                                <p class="mt-2 break-words text-xl font-bold text-slate-900 sm:text-2xl" x-text="formatNumber(results.totalInterest)"></p>
                            </div>

                            <div class="rounded-2xl bg-violet-50 p-4">
                                <p class="text-sm font-medium text-violet-700">Monthly + Extra</p>
                                <p class="mt-2 break-words text-xl font-bold text-slate-900 sm:text-2xl" x-text="formatNumber(results.monthlyPaymentWithExtra)"></p>
                            </div>

                            <div class="rounded-2xl bg-pink-50 p-4">
                                <p class="text-sm font-medium text-pink-700">Total Payment + Extra</p>
                                <p class="mt-2 break-words text-xl font-bold text-slate-900 sm:text-2xl" x-text="formatNumber(results.totalPaymentWithExtra)"></p>
                            </div>

                            <div class="rounded-2xl bg-cyan-50 p-4">
                                <p class="text-sm font-medium text-cyan-700">Months with Extra</p>
                                <p class="mt-2 break-words text-xl font-bold text-slate-900 sm:text-2xl" x-text="formatNumber(results.estimatedMonthsWithExtra)"></p>
                            </div>
                        </div>
                    </section>

                    <!-- Amortization -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Early Amortization Preview</h2>
                            <p class="mt-1 text-sm text-slate-500">First few payments based on the current estimate.</p>
                        </div>

                        <div class="mt-6 -mx-4 overflow-x-auto sm:mx-0">
                            <div class="min-w-[680px] px-4 sm:px-0">
                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <table class="w-full divide-y divide-slate-200">
                                        <thead class="bg-slate-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Month</th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Payment</th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Principal</th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Interest</th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-200 bg-white">
                                            <template x-if="schedulePreview.length === 0">
                                                <tr>
                                                    <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">
                                                        Enter loan details to see the payment preview.
                                                    </td>
                                                </tr>
                                            </template>

                                            <template x-for="item in schedulePreview" :key="item.month">
                                                <tr>
                                                    <td class="px-4 py-3 text-sm text-slate-700" x-text="item.month"></td>
                                                    <td class="px-4 py-3 text-sm text-slate-700" x-text="formatNumber(item.payment)"></td>
                                                    <td class="px-4 py-3 text-sm text-slate-700" x-text="formatNumber(item.principal)"></td>
                                                    <td class="px-4 py-3 text-sm text-slate-700" x-text="formatNumber(item.interest)"></td>
                                                    <td class="px-4 py-3 text-sm text-slate-700" x-text="formatNumber(item.balance)"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <p class="mt-3 text-xs text-slate-500 sm:text-sm">
                            On smaller screens, swipe sideways to view the full table.
                        </p>
                    </section>

                    <!-- Why -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            This loan calculator helps borrowers understand repayment before taking a loan,
                            compare interest costs, estimate monthly burden and see how extra payments can reduce total interest.
                        </p>
                    </section>

                    <!-- How -->
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
                                <li><strong class="text-slate-900">1.</strong> Enter the total loan amount.</li>
                                <li><strong class="text-slate-900">2.</strong> Enter the annual interest rate.</li>
                                <li><strong class="text-slate-900">3.</strong> Enter the repayment period in years.</li>
                                <li><strong class="text-slate-900">4.</strong> Add optional extra monthly payment if you want to compare savings.</li>
                                <li><strong class="text-slate-900">5.</strong> Review monthly payment, total cost and early repayment preview.</li>
                            </ol>
                        </div>
                    </section>

                    <!-- FAQ -->
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

                    <!-- Related -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Related Money and Utility Tools</h2>
                                <p class="mt-1 text-sm text-slate-500">
                                    Explore more useful tools for loans, pricing and business calculations.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/discount-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Discount Calculator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Calculate discounts, sale prices and savings quickly.</p>
                            </a>

                            <a href="{{ url('/tools/percentage-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Percentage Calculator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Calculate percentages, increase and decrease instantly.</p>
                            </a>

                            <a href="{{ url('/tools/invoice-generator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Invoice Generator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Create invoices for products and services online.</p>
                            </a>
                        </div>

                        <div class="mt-10 grid gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">When a loan calculator is useful</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    A loan calculator is useful when planning personal borrowing, comparing financing options,
                                    checking affordability, managing repayment plans and understanding long-term interest costs.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-slate-900">What this tool can estimate</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    This tool can estimate monthly repayment, total payment, total interest and the effect
                                    of adding extra monthly payments to finish the loan faster.
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