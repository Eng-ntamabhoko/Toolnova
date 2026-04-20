<div class="space-y-8">
    <section class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Lesson Plan Wizard</p>
                    <h2 class="text-2xl font-semibold text-slate-900">Complete the tool step by step</h2>
                </div>
                <div class="text-sm font-semibold text-slate-700">Step <span x-text="currentStep"></span> of <span x-text="steps.length"></span></div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                <template x-for="step in steps" :key="step.id">
                    <button type="button"
                            @click="currentStep = step.id"
                            class="rounded-2xl border px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.18em] transition focus:outline-none"
                            :class="currentStep === step.id ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-slate-200 bg-white text-slate-600 hover:border-slate-300'">
                        <span x-text="`Step ${step.id}`"></span>
                        <div class="mt-1 text-[11px] leading-4 font-medium" x-text="step.label"></div>
                    </button>
                </template>
            </div>

            <div class="mt-4 h-2 overflow-hidden rounded-full bg-slate-200">
                <div class="h-2 rounded-full bg-indigo-600 transition-all" :style="{ width: progressWidth }"></div>
            </div>
        </div>
    </section>

    <section x-show="currentStep === 1" x-cloak class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
        <div class="mb-6 flex flex-col gap-2">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Basic Info</p>
            <h2 class="text-2xl font-semibold text-slate-900">Preliminary Information</h2>
            <p class="text-sm leading-6 text-slate-600">Fill in the lesson basics so the preview reflects your school, class, and schedule.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">School Name</label>
                <input type="text" x-model="form.school_name" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Teacher Name</label>
                <input type="text" x-model="form.teacher_name" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Form</label>
                <select x-model="form.form_id" @change="loadTopics()" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    <option value="">Select form</option>
                    @foreach($forms as $form)
                        <option value="{{ $form->id }}">{{ $form->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Subject</label>
                <select x-model="form.subject_id" @change="loadTopics()" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    <option value="">Select subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Date</label>
                <input type="date" x-model="form.lesson_date" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Time</label>
                <input type="text" x-model="form.lesson_time" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
            </div>
        </div>
    </section>

    <section x-show="currentStep === 2" x-cloak class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
        <div class="mb-6 flex flex-col gap-2">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Topic Selection</p>
            <h2 class="text-2xl font-semibold text-slate-900">Choose Topic & Subtopic</h2>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Topic</label>
                    <select x-model="form.topic_id" @change="loadSubtopics()" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        <option value="">Select topic</option>
                        <template x-for="topic in topics" :key="topic.id">
                            <option :value="topic.id" x-text="topic.title"></option>
                        </template>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Subtopic</label>
                    <select x-model="form.subtopic_id" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        <option value="">Select subtopic (optional)</option>
                        <template x-for="subtopic in subtopics" :key="subtopic.id">
                            <option :value="subtopic.id" x-text="subtopic.title"></option>
                        </template>
                    </select>
                </div>
            </div>

            <div>
                <button type="button"
                        @click="generateDraft()"
                        class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-colors">
                    Load Official Content
                </button>
            </div>
        </div>
    </section>

    <section x-show="currentStep === 3" x-cloak class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
        <div class="mb-6 flex flex-col gap-2">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Students</p>
            <h2 class="text-2xl font-semibold text-slate-900">Student Information</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <div class="mb-4 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Registered</p>
                        <p class="text-sm text-slate-500">Total registered class size</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-600">Girls</label>
                        <input type="number" min="0" x-model.number="form.registered_girls" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-600">Boys</label>
                        <input type="number" min="0" x-model.number="form.registered_boys" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-600">Total</label>
                        <input type="number" :value="registeredTotal" readonly class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900">
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <div class="mb-4 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Present</p>
                        <p class="text-sm text-slate-500">Attendance for this lesson</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-600">Girls</label>
                        <input type="number" min="0" x-model.number="form.present_girls" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-600">Boys</label>
                        <input type="number" min="0" x-model.number="form.present_boys" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-slate-600">Total</label>
                        <input type="number" :value="presentTotal" readonly class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section x-show="currentStep === 4" x-cloak class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
        <div class="mb-6 flex flex-col gap-2">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Competence</p>
            <h2 class="text-2xl font-semibold text-slate-900">Competence Information</h2>
            <p class="text-sm leading-6 text-slate-600">Provide the lesson content and reference material for the draft.</p>
        </div>

        <div class="grid gap-6">
            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700">Main Competence</label>
                <textarea x-model="draft.main_competence" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
            </div>

            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700">Specific Competence</label>
                <textarea x-model="draft.specific_competence" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
            </div>

            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700">Main Activity</label>
                <textarea x-model="draft.main_activity" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
            </div>

            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700">Specific Activity</label>
                <textarea x-model="draft.specific_activity" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
            </div>

            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700">Teaching and Learning Resources</label>
                <textarea x-model="draft.teaching_learning_resources" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
            </div>

            <div class="space-y-3">
                <label class="block text-sm font-semibold text-slate-700">References</label>
                <textarea x-model="draft.references_text" rows="5" class="w-full min-h-[140px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
            </div>
        </div>
    </section>

    <section x-show="currentStep === 5" x-cloak class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
        <div class="mb-6 flex flex-col gap-2">
            <p class="text-sm uppercase tracking-[0.24em] text-slate-500">IDDR stages</p>
            <h2 class="text-2xl font-semibold text-slate-900">Structured Teaching Stages</h2>
            <p class="text-sm leading-6 text-slate-600">Each stage is separated into its own focused workspace panel for the lesson plan.</p>
        </div>

        @include('tools.partials.iddr-section')
    </section>

    <section x-show="currentStep === 6" x-cloak class="space-y-8">
        <div class="rounded-[28px] border border-slate-200 bg-white p-8 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
            <div class="mb-6 flex flex-col gap-2">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Remarks</p>
                <h2 class="text-2xl font-semibold text-slate-900">Finish & Review</h2>
                <p class="text-sm leading-6 text-slate-600">Add final notes and confirm the lesson plan preview before saving.</p>
            </div>
            <textarea x-model="form.remarks" rows="6" class="w-full min-h-[160px] rounded-2xl border border-slate-300 px-4 py-4 text-sm text-slate-900 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-vertical"></textarea>
        </div>

        <div class="lg:hidden">
            @include('tools.partials.lesson-plan-preview')
        </div>

        <div class="flex flex-col gap-4 rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-slate-600">Use Previous to update any step, or save when ready.</p>
                <div class="flex flex-wrap items-center gap-3">
                    <button type="button"
                            @click="resetForm()"
                            class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-colors">
                        Reset
                    </button>
                    <button type="button"
                            @click="saveDraft()"
                            class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm shadow-emerald-500/10 hover:bg-emerald-700 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors">
                        Save Draft
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-[0_20px_40px_rgba(15,23,42,0.08)]">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <button type="button"
                        @click="prevStep()"
                        x-show="currentStep > 1"
                        class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-colors">
                    Previous
                </button>
                <button type="button"
                        @click="nextStep()"
                        x-show="currentStep < steps.length"
                        class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-colors">
                    Next
                </button>
            </div>
            <p class="text-sm text-slate-500">Step <span x-text="currentStep"></span> of <span x-text="steps.length"></span></p>
        </div>
    </div>
</div>
