<div
    x-data="{ show: false }"
    @scroll.window="show = (window.pageYOffset || document.documentElement.scrollTop) > 360"
    class="pointer-events-none fixed bottom-0 left-0 right-0 z-50 flex justify-end p-4 sm:p-6"
    aria-live="polite"
>
    <button
        type="button"
        x-show="show"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        x-cloak
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="no-print pointer-events-auto flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-indigo-600 text-white shadow-lg shadow-indigo-950/50 transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2 focus:ring-offset-slate-50 sm:h-14 sm:w-14"
        aria-label="Back to top"
    >
        <svg class="h-6 w-6 sm:h-7 sm:w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>
    </button>
</div>
