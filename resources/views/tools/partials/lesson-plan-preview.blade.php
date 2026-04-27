<aside class="space-y-6 lg:sticky lg:top-6 lg:max-h-[calc(100vh-140px)] lg:min-h-0 lg:overflow-hidden">
    <div class="space-y-6 rounded-[28px] border border-slate-200 bg-slate-50 p-8 shadow-[0_20px_40px_rgba(15,23,42,0.06)] lg:h-full">
        <div class="space-y-3">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Live Preview</p>
            <h2 class="text-2xl font-semibold text-slate-900">Lesson Plan Preview</h2>
            <p class="text-sm leading-6 text-slate-600">A structured display of the lesson plan content and TIE-style teaching process.</p>
        </div>

        <div class="space-y-6 overflow-y-auto lg:max-h-[calc(100vh-220px)]">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900 mb-4">Lesson Summary</h3>
                <div class="grid grid-cols-1 gap-4 text-sm text-slate-700 sm:grid-cols-2">
                    <div class="space-y-3 rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">School</p>
                        <p class="text-slate-600" x-text="form.school_name || '—'"></p>
                    </div>
                    <div class="space-y-3 rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Teacher</p>
                        <p class="text-slate-600" x-text="form.teacher_name || '—'"></p>
                    </div>
                    <div class="space-y-3 rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Form / Subject</p>
                        <p class="text-slate-600"><span x-text="selectedFormName"></span> / <span x-text="selectedSubjectName"></span></p>
                    </div>
                    <div class="space-y-3 rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Date / Time</p>
                        <p class="text-slate-600"><span x-text="form.lesson_date || '—'"></span> / <span x-text="form.lesson_time || '—'"></span></p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900 mb-4">Student Attendance</h3>
                <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-slate-50">
                    <table class="min-w-full text-sm text-slate-700">
                        <thead class="bg-slate-100 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 text-left">Type</th>
                                <th class="px-4 py-3 text-center">Girls</th>
                                <th class="px-4 py-3 text-center">Boys</th>
                                <th class="px-4 py-3 text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            <tr class="bg-white">
                                <td class="px-4 py-3 font-medium">Registered</td>
                                <td class="px-4 py-3 text-center" x-text="form.registered_girls || '0'"></td>
                                <td class="px-4 py-3 text-center" x-text="form.registered_boys || '0'"></td>
                                <td class="px-4 py-3 text-center font-semibold" x-text="registeredTotal || '0'"></td>
                            </tr>
                            <tr class="bg-white">
                                <td class="px-4 py-3 font-medium">Present</td>
                                <td class="px-4 py-3 text-center" x-text="form.present_girls || '0'"></td>
                                <td class="px-4 py-3 text-center" x-text="form.present_boys || '0'"></td>
                                <td class="px-4 py-3 text-center font-semibold" x-text="presentTotal || '0'"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900 mb-4">Core Draft</h3>
                <div class="space-y-4 text-sm text-slate-700">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Main Competence</p>
                        <p class="mt-2 whitespace-pre-wrap leading-relaxed" x-text="draft.main_competence || 'Not loaded yet'"></p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Specific Competence</p>
                        <p class="mt-2 whitespace-pre-wrap leading-relaxed" x-text="draft.specific_competence || 'Not loaded yet'"></p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Main Activity</p>
                        <p class="mt-2 whitespace-pre-wrap leading-relaxed" x-text="draft.main_activity || 'Not loaded yet'"></p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Specific Activity</p>
                        <p class="mt-2 whitespace-pre-wrap leading-relaxed" x-text="draft.specific_activity || 'Not loaded yet'"></p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900 mb-4">Resources & References</h3>
                <div class="space-y-4 text-sm text-slate-700">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">Teaching & Learning Resources</p>
                        <p class="mt-2 whitespace-pre-wrap leading-relaxed font-sans" x-text="draft.teaching_learning_resources || 'Not loaded yet'"></p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="font-semibold text-slate-900">References</p>
                        <p class="mt-2 whitespace-pre-wrap leading-relaxed font-sans" x-text="draft.references_text || 'Not loaded yet'"></p>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-4 flex items-center justify-between gap-4">
                    <h3 class="text-base font-semibold text-slate-900">Teaching and Learning Process</h3>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-slate-600">TIE Style</span>
                </div>

                <div class="hidden lg:block overflow-x-auto rounded-3xl border border-slate-200 bg-slate-50">
                    <table class="min-w-full text-sm text-slate-700">
                        <thead class="bg-slate-100 text-slate-600">
                            <tr>
                                <th class="px-4 py-3 text-left">Stage</th>
                                <th class="px-4 py-3 text-center">Time</th>
                                <th class="px-4 py-3 text-left">Teaching</th>
                                <th class="px-4 py-3 text-left">Learning</th>
                                <th class="px-4 py-3 text-left">Assessment</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            <template x-for="section in iddrSections" :key="section.key">
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-800" x-text="section.label"></td>
                                    <td class="px-4 py-3 text-center text-slate-600" x-text="draft[section.key]?.time ? draft[section.key].time + ' min' : '—'"></td>
                                    <td class="px-4 py-3 whitespace-pre-wrap text-slate-600" x-text="draft[section.key]?.teaching || '—'"></td>
                                    <td class="px-4 py-3 whitespace-pre-wrap text-slate-600" x-text="draft[section.key]?.learning || '—'"></td>
                                    <td class="px-4 py-3 whitespace-pre-wrap text-slate-600" x-text="draft[section.key]?.assessment || '—'"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div class="space-y-4 lg:hidden">
                    <template x-for="section in iddrSections" :key="section.key">
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                            <div class="mb-3 flex items-center justify-between gap-4">
                                <p class="font-semibold text-slate-900" x-text="section.label"></p>
                                <span class="text-xs uppercase tracking-[0.16em] text-slate-600">Duration</span>
                            </div>
                            <div class="grid grid-cols-2 gap-3 text-sm text-slate-700">
                                <div class="rounded-2xl bg-white p-3 shadow-sm">
                                    <p class="text-xs text-slate-500">Time</p>
                                    <p class="mt-1 font-semibold text-slate-900" x-text="draft[section.key]?.time ? draft[section.key].time + ' min' : '—'"></p>
                                </div>
                                <div class="rounded-2xl bg-white p-3 shadow-sm col-span-2">
                                    <p class="text-xs text-slate-500">Teaching</p>
                                    <p class="mt-1 whitespace-pre-wrap text-slate-700" x-text="draft[section.key]?.teaching || '—'"></p>
                                </div>
                                <div class="rounded-2xl bg-white p-3 shadow-sm col-span-2">
                                    <p class="text-xs text-slate-500">Learning</p>
                                    <p class="mt-1 whitespace-pre-wrap text-slate-700" x-text="draft[section.key]?.learning || '—'"></p>
                                </div>
                                <div class="rounded-2xl bg-white p-3 shadow-sm col-span-2">
                                    <p class="text-xs text-slate-500">Assessment</p>
                                    <p class="mt-1 whitespace-pre-wrap text-slate-700" x-text="draft[section.key]?.assessment || '—'"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-slate-900 mb-3">Remarks</h3>
                <div class="rounded-2xl bg-slate-50 p-4 text-sm leading-relaxed text-slate-600 whitespace-pre-wrap" x-text="form.remarks || 'No remarks yet.'"></div>
            </div>
        </div>
    </div>
</aside>
