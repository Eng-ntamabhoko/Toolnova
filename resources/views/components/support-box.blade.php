<section class="mt-12 rounded-3xl bg-slate-900 p-6 text-white shadow-lg sm:p-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h3 class="text-lg font-bold">Need help or found an issue?</h3>
            <p class="mt-1 text-sm text-slate-300">
                Contact us instantly via WhatsApp or send a quick message.
            </p>
        </div>

        <div class="flex gap-3 flex-shrink-0">
            <a href="{{ url('/contact') }}"
               class="rounded-xl bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                Send Message
            </a>

            <a href="https://wa.me/255698751800?text=Hi%20I%20need%20help%20with%20ToolNova"
               target="_blank"
               rel="noopener noreferrer"
               class="rounded-xl bg-green-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-400">
                WhatsApp
            </a>
        </div>
    </div>
</section>
