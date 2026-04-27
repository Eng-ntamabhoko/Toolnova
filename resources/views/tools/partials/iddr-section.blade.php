<section class="space-y-4">
    <div class="mb-1 flex items-center justify-between gap-4 rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
        <div>
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">IDDR stages</p>
            <h2 class="text-2xl font-semibold text-slate-900">Structured Teaching Stages</h2>
            <p class="text-sm leading-6 text-slate-600">Each stage is separated into its own workspace panel for clarity.</p>
        </div>
    </div>

    <template x-for="section in iddrSections" :key="section.key">
        <div class="group rounded-[28px] border border-slate-200 bg-white shadow-[0_18px_35px_rgba(15,23,42,0.05)]">
            <button type="button"
                    @click="toggleIddr(section.key)"
                    class="w-full flex items-center justify-between gap-4 rounded-[28px] px-6 py-5 text-left text-lg font-semibold text-slate-900 transition-colors hover:bg-slate-50">
                <span x-text="section.label"></span>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                    <span x-show="activeIddrSection !== section.key">+</span>
                    <span x-show="activeIddrSection === section.key">−</span>
                </span>
            </button>

            <div x-show="activeIddrSection === section.key" x-transition class="border-t border-slate-200 px-6 py-6 bg-slate-50">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Time (Minutes)</label>
                        <input type="number" min="0" x-model.number="draft[section.key].time" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-700">Teaching Activities</label>
                        <textarea x-model="draft[section.key].teaching" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-700">Learning Activities</label>
                        <textarea x-model="draft[section.key].learning" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-slate-700">Assessment Criteria</label>
                        <textarea x-model="draft[section.key].assessment" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </template>
</section>
