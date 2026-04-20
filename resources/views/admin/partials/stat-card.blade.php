<div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
    <p class="text-sm font-medium text-slate-500">{{ $label }}</p>
    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $value }}</p>
    @if(!empty($subLabel))
        <p class="mt-1 text-xs text-slate-500">{{ $subLabel }}</p>
    @endif
</div>
