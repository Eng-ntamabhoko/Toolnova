@extends('layouts.dashboard')

@section('title', 'My Invoices')

@section('content')
<div class="space-y-6">
    <!-- Header with CTA Button -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">My Invoices</h2>
            <p class="mt-1 text-slate-600">Create, manage, and download your invoices.</p>
        </div>
        <a href="{{ url('/tools/invoice-generator') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 hover:bg-indigo-700 transition">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New Invoice
        </a>
    </div>

    @if ($invoices->isEmpty())
        <!-- Empty State -->
        <div class="rounded-3xl border border-slate-200 bg-white p-12 shadow-sm">
            <div class="text-center">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-600 mx-auto mb-4">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">No invoices yet</h3>
                <p class="text-slate-600 mb-6 max-w-md mx-auto">Generate your first invoice using our Invoice Generator. Professional invoices in seconds.</p>
                <a href="{{ url('/tools/invoice-generator') }}" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 hover:bg-indigo-700 transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Start Creating Invoice
                </a>
            </div>
        </div>
    @else
        <!-- Invoices Table -->
        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Invoice Number</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Amount</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Created</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($invoices as $invoice)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-900">#{{ $invoice->invoice_number ?? '0000' }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    ${{ number_format($invoice->total ?? 0, 2) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $invoice->created_at->format('M d, Y') ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex gap-2 justify-end">
                                        <button class="rounded-lg bg-indigo-100 px-3 py-2 text-xs font-medium text-indigo-700 hover:bg-indigo-200 transition">
                                            View
                                        </button>
                                        <button class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-200 transition">
                                            Download
                                        </button>
                                        <button class="rounded-lg bg-red-100 px-3 py-2 text-xs font-medium text-red-700 hover:bg-red-200 transition">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($invoices->hasPages())
            <div class="flex justify-center">
                {{ $invoices->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
