@extends('layouts.app')

@section('title', 'Invoice Generator - ToolNova')
@section('meta_description', 'Create professional invoices online for products and services with ToolNova Invoice Generator.')

@section('content')
<div x-data="invoiceGenerator()" data-tool-slug="invoice-generator" class="bg-slate-50 overflow-x-hidden">

    <section class="relative overflow-hidden bg-slate-950 print:hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-medium text-blue-200 sm:text-sm">
                    Free Online Tool
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Invoice Generator
                </h1>

                <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Create professional invoices for products and services with automatic totals, discount, tax and a print-ready layout.
                </p>
            </div>
        </div>
    </section>

    <section class="py-6 sm:py-10 print:py-0">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 print:max-w-none print:px-0">
            <div class="flex flex-col gap-6 lg:grid lg:grid-cols-12 lg:gap-8 print:block">

                <!-- Form -->
                <aside class="w-full lg:col-span-5 print:hidden">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Invoice Details</h2>
                            <p class="mt-1 text-sm text-slate-500">Enter seller, customer and item information.</p>
                        </div>

                        <div class="mt-6 space-y-6">
                            <div>
                                <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Your Business</h3>
                                <div class="mt-3 grid gap-3">
                                    <input x-model="businessName" type="text" placeholder="Business name" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    <input x-model="businessEmail" type="text" placeholder="Business email" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    <input x-model="businessPhone" type="text" placeholder="Business phone" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    <textarea x-model="businessAddress" rows="3" placeholder="Business address" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"></textarea>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Client Details</h3>
                                <div class="mt-3 grid gap-3">
                                    <input x-model="clientName" type="text" placeholder="Client name" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    <input x-model="clientEmail" type="text" placeholder="Client email" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    <input x-model="clientPhone" type="text" placeholder="Client phone" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    <textarea x-model="clientAddress" rows="3" placeholder="Client address" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"></textarea>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Invoice Meta</h3>
                                <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                    <input x-model="invoiceNumber" type="text" placeholder="Invoice number" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    <select x-model="currency" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="TZS">TZS</option>
                                        <option value="KES">KES</option>
                                    </select>
                                    <div>
                                        <label class="mb-2 block text-sm font-semibold text-slate-700">Invoice Date</label>
                                        <input x-model="invoiceDate" type="date" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-semibold text-slate-700">Due Date</label>
                                        <input x-model="dueDate" type="date" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between gap-3">
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Items</h3>
                                    <button
                                        type="button"
                                        @click="addItem()"
                                        class="rounded-2xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100"
                                    >
                                        Add Item
                                    </button>
                                </div>

                                <div class="mt-3 space-y-4">
                                    <template x-for="(item, index) in items" :key="index">
                                        <div class="rounded-2xl border border-slate-200 p-4">
                                            <div class="grid gap-3">
                                                <input x-model="item.description" type="text" placeholder="Item description" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

                                                <div class="grid grid-cols-2 gap-3">
                                                    <input x-model="item.quantity" type="number" min="1" step="any" placeholder="Qty" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                                    <input x-model="item.price" type="number" min="0" step="any" placeholder="Price" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                                </div>

                                                <div class="flex items-center justify-between gap-3">
                                                    <p class="text-sm text-slate-500">
                                                        Item Total:
                                                        <span class="font-bold text-slate-900" x-text="formatMoney(itemTotal(item))"></span>
                                                    </p>

                                                    <button
                                                        type="button"
                                                        @click="removeItem(index)"
                                                        class="rounded-2xl border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Adjustments</h3>
                                <div class="mt-3 grid gap-3 sm:grid-cols-2">
                                    <select x-model="discountType" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                        <option value="percent">Discount %</option>
                                        <option value="fixed">Discount Fixed</option>
                                    </select>
                                    <input x-model="discountValue" type="number" step="any" placeholder="Discount value" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">

                                    <select x-model="taxType" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                        <option value="percent">Tax %</option>
                                        <option value="fixed">Tax Fixed</option>
                                    </select>
                                    <input x-model="taxValue" type="number" step="any" placeholder="Tax value" class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                                </div>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700">Notes</label>
                                <textarea x-model="notes" rows="4" placeholder="Additional payment notes or thank you message..." class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"></textarea>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <button
                                type="button"
                                @click="copyInvoice()"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                            >
                                <span x-text="copied ? 'Copied' : 'Copy Invoice'"></span>
                            </button>

                            <button
                                type="button"
                                @click="printInvoice()"
                                class="w-full rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700"
                            >
                                Print Invoice
                            </button>

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

                <!-- Preview -->
                <div class="w-full space-y-6 lg:col-span-7 print:space-y-0">

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8 print:rounded-none print:border-0 print:p-0 print:shadow-none">
                        <div class="mb-8 flex flex-col gap-6 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
                            <div>
                                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900">INVOICE</h2>
                                <p class="mt-2 text-sm text-slate-500">Professional invoice preview</p>
                            </div>

                            <div class="text-sm text-slate-600">
                                <p><span class="font-semibold text-slate-900">Invoice #:</span> <span x-text="invoiceNumber || '--'"></span></p>
                                <p class="mt-1"><span class="font-semibold text-slate-900">Invoice Date:</span> <span x-text="invoiceDate || '--'"></span></p>
                                <p class="mt-1"><span class="font-semibold text-slate-900">Due Date:</span> <span x-text="dueDate || '--'"></span></p>
                            </div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wide text-slate-500">From</p>
                                <div class="mt-3 text-sm leading-7 text-slate-700">
                                    <p class="font-bold text-slate-900" x-text="businessName || 'Your business name'"></p>
                                    <p x-text="businessEmail || 'business@email.com'"></p>
                                    <p x-text="businessPhone || '+000 000 000'"></p>
                                    <p x-text="businessAddress || 'Business address'"></p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Bill To</p>
                                <div class="mt-3 text-sm leading-7 text-slate-700">
                                    <p class="font-bold text-slate-900" x-text="clientName || 'Client name'"></p>
                                    <p x-text="clientEmail || 'client@email.com'"></p>
                                    <p x-text="clientPhone || '+000 000 000'"></p>
                                    <p x-text="clientAddress || 'Client address'"></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">Description</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">Qty</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">Price</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr>
                                            <td class="px-4 py-4 text-sm text-slate-700" x-text="item.description || 'Item description'"></td>
                                            <td class="px-4 py-4 text-sm text-slate-700" x-text="item.quantity || 0"></td>
                                            <td class="px-4 py-4 text-sm text-slate-700" x-text="formatMoney(item.price)"></td>
                                            <td class="px-4 py-4 text-sm font-semibold text-slate-900" x-text="formatMoney(itemTotal(item))"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <div class="w-full max-w-md space-y-3">
                                <div class="flex items-center justify-between text-sm text-slate-700">
                                    <span>Subtotal</span>
                                    <span class="font-semibold" x-text="formatMoney(subtotal)"></span>
                                </div>

                                <div class="flex items-center justify-between text-sm text-slate-700">
                                    <span>Discount</span>
                                    <span class="font-semibold" x-text="formatMoney(discountAmount)"></span>
                                </div>

                                <div class="flex items-center justify-between text-sm text-slate-700">
                                    <span>Tax</span>
                                    <span class="font-semibold" x-text="formatMoney(taxAmount)"></span>
                                </div>

                                <div class="flex items-center justify-between border-t border-slate-200 pt-3 text-base font-bold text-slate-900">
                                    <span>Total</span>
                                    <span x-text="formatMoney(grandTotal)"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 border-t border-slate-200 pt-6">
                            <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Notes</p>
                            <p class="mt-3 text-sm leading-7 text-slate-700" x-text="notes || 'Thank you for your business.'"></p>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8 print:hidden">
                        <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Why Use This Tool</h2>
                        <p class="mt-4 leading-7 text-slate-600">
                            This invoice generator helps freelancers, agencies, consultants and small businesses create
                            clean invoices quickly with automatic totals, discount and tax calculations.
                        </p>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8 print:hidden">
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
                                <li><strong class="text-slate-900">1.</strong> Enter your business information.</li>
                                <li><strong class="text-slate-900">2.</strong> Enter client details and invoice dates.</li>
                                <li><strong class="text-slate-900">3.</strong> Add one or more items with quantity and price.</li>
                                <li><strong class="text-slate-900">4.</strong> Apply discount or tax if needed.</li>
                                <li><strong class="text-slate-900">5.</strong> Print the invoice or copy the invoice summary.</li>
                            </ol>
                        </div>
                    </section>

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8 print:hidden">
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

                    <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8 print:hidden">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Related Business and Utility Tools</h2>
                                <p class="mt-1 text-sm text-slate-500">
                                    Explore more useful tools for pricing, finance and productivity.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/discount-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Discount Calculator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Calculate discounts, sale prices and savings.</p>
                            </a>

                            <a href="{{ url('/tools/loan-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Loan Calculator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Estimate monthly payments and total interest.</p>
                            </a>

                            <a href="{{ url('/tools/percentage-calculator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Percentage Calculator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Calculate percentages and changes quickly.</p>
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
    'pageSlug' => 'invoice-generator',
    'comments' => $comments ?? collect()
])

@endsection