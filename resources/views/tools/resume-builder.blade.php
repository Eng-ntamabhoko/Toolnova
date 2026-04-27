@extends('layouts.app')

@section('title', 'Resume Builder - ToolNova')
@section('meta_description', 'Build a professional ATS-friendly resume online with ToolNova Resume Builder.')

@section('content')
<div x-data="resumeBuilder()" data-tool-slug="resume-builder" class="bg-slate-50 overflow-x-hidden">

    <section class="relative overflow-hidden bg-slate-950 print:hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(59,130,246,0.22),transparent_35%),radial-gradient(circle_at_bottom_right,rgba(14,165,233,0.18),transparent_30%)]"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-medium text-blue-200 sm:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 3.75A2.25 2.25 0 0 0 5.25 6v12A2.25 2.25 0 0 0 7.5 20.25h9A2.25 2.25 0 0 0 18.75 18V8.56a2.25 2.25 0 0 0-.659-1.591l-2.81-2.81A2.25 2.25 0 0 0 13.69 3.5H7.5Z" clip-rule="evenodd"/>
                    </svg>
                    Resume Builder
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Build a clean, professional resume
                </h1>

                <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Create a stronger resume with smart guidance, ATS-oriented scoring, keyword matching, and a polished PDF export.
                </p>
            </div>
        </div>
    </section>

    <section class="py-6 sm:py-10 print:py-0">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 print:max-w-none print:px-0">
            <div class="flex flex-col gap-6 lg:grid lg:grid-cols-12 lg:gap-8 print:block">

                <aside class="w-full lg:col-span-5 print:hidden">
                    <div class="space-y-6">

                        <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Resume Editor</h2>
                                    <p class="mt-1 text-sm text-slate-500">Fill each section and review the live preview as you go.</p>
                                </div>

                                <select
                                    x-model="selectedTemplate"
                                    class="rounded-2xl border border-slate-300 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                                    <option value="professional">Professional</option>
                                    <option value="clean">Clean</option>
                                </select>
                            </div>

                            <div class="mt-6 space-y-6">

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Personal Details</h3>
                                    <div class="mt-3 grid gap-3">
                                        <input
                                            x-model="personal.fullName"
                                            type="text"
                                            placeholder="Full name"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                        >

                                        <input
                                            x-model="personal.jobTitle"
                                            type="text"
                                            placeholder="Target job title"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                        >

                                        <div class="grid gap-3 sm:grid-cols-2">
                                            <div>
                                                <input
                                                    x-model="personal.email"
                                                    type="email"
                                                    placeholder="Email"
                                                    class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                    :class="errors.email ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                                >
                                                <p x-show="errors.email" x-text="errors.email" class="mt-1 text-xs text-rose-600"></p>
                                            </div>

                                            <div>
                                                <input
                                                    x-model="personal.phone"
                                                    type="text"
                                                    placeholder="Phone"
                                                    class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                    :class="errors.phone ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                                >
                                                <p x-show="errors.phone" x-text="errors.phone" class="mt-1 text-xs text-rose-600"></p>
                                            </div>
                                        </div>

                                        <div class="grid gap-3 sm:grid-cols-2">
                                            <input
                                                x-model="personal.city"
                                                type="text"
                                                placeholder="City"
                                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                            >
                                            <input
                                                x-model="personal.country"
                                                type="text"
                                                placeholder="Country"
                                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                            >
                                        </div>

                                        <div class="grid gap-3 sm:grid-cols-2">
                                            <div>
                                                <input
                                                    x-model="personal.website"
                                                    type="url"
                                                    placeholder="Portfolio or website"
                                                    class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                    :class="errors.website ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                                >
                                                <p x-show="errors.website" x-text="errors.website" class="mt-1 text-xs text-rose-600"></p>
                                            </div>

                                            <div>
                                                <input
                                                    x-model="personal.linkedin"
                                                    type="url"
                                                    placeholder="LinkedIn profile"
                                                    class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                    :class="errors.linkedin ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                                >
                                                <p x-show="errors.linkedin" x-text="errors.linkedin" class="mt-1 text-xs text-rose-600"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Professional Summary</h3>
                                    <textarea
                                        x-model="summary"
                                        rows="5"
                                        placeholder="Write a concise summary that explains your background, strengths and value."
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>

                                    <div class="mt-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="flex items-center justify-between gap-3">
                                            <h4 class="text-xs font-bold uppercase tracking-wide text-slate-700">Summary Assistant</h4>
                                            <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-700">
                                                <span x-text="summaryStrengthLabel"></span>
                                            </span>
                                        </div>

                                        <div class="mt-3 grid gap-3 sm:grid-cols-3">
                                            <div class="rounded-xl bg-white p-3">
                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Length</p>
                                                <p class="mt-1 text-lg font-bold text-slate-900" x-text="summaryLength"></p>
                                            </div>

                                            <div class="rounded-xl bg-white p-3">
                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Keywords Used</p>
                                                <p class="mt-1 text-lg font-bold text-slate-900" x-text="summaryKeywordHits"></p>
                                            </div>

                                            <div class="rounded-xl bg-white p-3">
                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Clarity Score</p>
                                                <p class="mt-1 text-lg font-bold text-slate-900" x-text="summaryClarityScore"></p>
                                            </div>
                                        </div>

                                        <template x-if="summarySuggestions.length">
                                            <ul class="mt-4 space-y-2 text-sm text-slate-700">
                                                <template x-for="(tip, index) in summarySuggestions" :key="index">
                                                    <li class="flex gap-2">
                                                        <span class="text-blue-600">•</span>
                                                        <span x-text="tip"></span>
                                                    </li>
                                                </template>
                                            </ul>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Target Job Description</h3>
                                    <p class="mt-1 text-sm text-slate-500">Paste a job description to compare your resume against the role requirements.</p>
                                    <textarea
                                        x-model="jobDescription"
                                        rows="6"
                                        placeholder="Paste the job description here to improve keyword alignment and ATS relevance."
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Skills</h3>
                                    <p class="mt-1 text-sm text-slate-500">Separate each skill with a comma.</p>
                                    <textarea
                                        x-model="skills"
                                        rows="3"
                                        placeholder="Example: Excel, Customer service, Sales, Communication, Reporting"
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Work Experience</h3>
                                        <button
                                            type="button"
                                            @click="addExperience()"
                                            class="rounded-2xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100"
                                        >
                                            Add Job
                                        </button>
                                    </div>

                                    <div class="mt-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="flex flex-wrap items-center gap-3">
                                            <div class="rounded-xl bg-white px-3 py-2">
                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Total Bullets</p>
                                                <p class="mt-1 text-lg font-bold text-slate-900" x-text="allBulletTexts.length"></p>
                                            </div>

                                            <div class="rounded-xl bg-white px-3 py-2">
                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Strong Bullets</p>
                                                <p class="mt-1 text-lg font-bold text-slate-900" x-text="strongBulletCount"></p>
                                            </div>

                                            <div class="rounded-xl bg-white px-3 py-2">
                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Quantified Bullets</p>
                                                <p class="mt-1 text-lg font-bold text-slate-900" x-text="quantifiedBulletCount"></p>
                                            </div>

                                            <div class="rounded-xl bg-white px-3 py-2">
                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Weak Bullets</p>
                                                <p class="mt-1 text-lg font-bold text-slate-900" x-text="weakBulletCount"></p>
                                            </div>
                                        </div>

                                        <template x-if="bulletSuggestions.length">
                                            <div class="mt-4">
                                                <h4 class="text-xs font-bold uppercase tracking-wide text-slate-700">Bullet Writing Tips</h4>
                                                <ul class="mt-3 space-y-2 text-sm text-slate-700">
                                                    <template x-for="(tip, index) in bulletSuggestions" :key="index">
                                                        <li class="flex gap-2">
                                                            <span class="text-blue-600">•</span>
                                                            <span x-text="tip"></span>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                        </template>
                                    </div>

                                    <div class="mt-3 space-y-4">
                                        <template x-for="(job, index) in experience" :key="index">
                                            <div class="rounded-2xl border border-slate-200 p-4">
                                                <div class="mb-4 flex items-center justify-between gap-3">
                                                    <p class="text-sm font-semibold text-slate-700">Job <span x-text="index + 1"></span></p>
                                                    <button
                                                        type="button"
                                                        @click="removeExperience(index)"
                                                        class="rounded-xl border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-600 transition hover:bg-rose-50"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>

                                                <div class="grid gap-3">
                                                    <input
                                                        x-model="job.role"
                                                        type="text"
                                                        placeholder="Job title"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >
                                                    <input
                                                        x-model="job.company"
                                                        type="text"
                                                        placeholder="Company name"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >
                                                    <input
                                                        x-model="job.location"
                                                        type="text"
                                                        placeholder="Location"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >

                                                    <div class="grid gap-3 sm:grid-cols-2">
                                                        <input
                                                            x-model="job.startDate"
                                                            type="text"
                                                            placeholder="Start date (e.g. Jan 2022)"
                                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >
                                                        <input
                                                            x-model="job.endDate"
                                                            type="text"
                                                            :disabled="job.current"
                                                            placeholder="End date (e.g. Oct 2025)"
                                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none disabled:bg-slate-100 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >
                                                    </div>

                                                    <label class="flex items-center gap-3 rounded-2xl border border-slate-200 p-3">
                                                        <input type="checkbox" x-model="job.current" class="h-4 w-4 rounded border-slate-300 text-blue-600">
                                                        <span class="text-sm font-medium text-slate-700">I currently work here</span>
                                                    </label>

                                                    <textarea
                                                        x-model="job.bullets"
                                                        rows="5"
                                                        placeholder="Add one achievement or responsibility per line. Example:&#10;Increased monthly sales by 18%&#10;Managed customer inquiries across phone and email"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    ></textarea>

                                                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-3">
                                                        <h4 class="text-xs font-bold uppercase tracking-wide text-slate-700">Bullet Assistant</h4>

                                                        <div class="mt-3 grid gap-3 sm:grid-cols-3">
                                                            <div class="rounded-xl bg-white p-3">
                                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Lines</p>
                                                                <p class="mt-1 text-base font-bold text-slate-900" x-text="bulletLines(job.bullets).length"></p>
                                                            </div>

                                                            <div class="rounded-xl bg-white p-3">
                                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Strong Lines</p>
                                                                <p class="mt-1 text-base font-bold text-slate-900" x-text="jobStrongBulletCount(job)"></p>
                                                            </div>

                                                            <div class="rounded-xl bg-white p-3">
                                                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Metrics Used</p>
                                                                <p class="mt-1 text-base font-bold text-slate-900" x-text="jobQuantifiedBulletCount(job)"></p>
                                                            </div>
                                                        </div>

                                                        <template x-if="jobBulletSuggestions(job).length">
                                                            <ul class="mt-3 space-y-2 text-sm text-slate-700">
                                                                <template x-for="(tip, tipIndex) in jobBulletSuggestions(job)" :key="tipIndex">
                                                                    <li class="flex gap-2">
                                                                        <span class="text-blue-600">•</span>
                                                                        <span x-text="tip"></span>
                                                                    </li>
                                                                </template>
                                                            </ul>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Education</h3>
                                        <button
                                            type="button"
                                            @click="addEducation()"
                                            class="rounded-2xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100"
                                        >
                                            Add Education
                                        </button>
                                    </div>

                                    <div class="mt-3 space-y-4">
                                        <template x-for="(item, index) in education" :key="index">
                                            <div class="rounded-2xl border border-slate-200 p-4">
                                                <div class="mb-4 flex items-center justify-between gap-3">
                                                    <p class="text-sm font-semibold text-slate-700">Education <span x-text="index + 1"></span></p>
                                                    <button
                                                        type="button"
                                                        @click="removeEducation(index)"
                                                        class="rounded-xl border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-600 transition hover:bg-rose-50"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>

                                                <div class="grid gap-3">
                                                    <input
                                                        x-model="item.school"
                                                        type="text"
                                                        placeholder="School or university"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >
                                                    <input
                                                        x-model="item.degree"
                                                        type="text"
                                                        placeholder="Degree or qualification"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >
                                                    <input
                                                        x-model="item.field"
                                                        type="text"
                                                        placeholder="Field of study"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >

                                                    <div class="grid gap-3 sm:grid-cols-2">
                                                        <input
                                                            x-model="item.startDate"
                                                            type="text"
                                                            placeholder="Start date"
                                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >
                                                        <input
                                                            x-model="item.endDate"
                                                            type="text"
                                                            placeholder="End date"
                                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Projects</h3>
                                        <button
                                            type="button"
                                            @click="addProject()"
                                            class="rounded-2xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100"
                                        >
                                            Add Project
                                        </button>
                                    </div>

                                    <div class="mt-3 space-y-4">
                                        <template x-for="(project, index) in projects" :key="index">
                                            <div class="rounded-2xl border border-slate-200 p-4">
                                                <div class="mb-4 flex items-center justify-between gap-3">
                                                    <p class="text-sm font-semibold text-slate-700">Project <span x-text="index + 1"></span></p>
                                                    <button
                                                        type="button"
                                                        @click="removeProject(index)"
                                                        class="rounded-xl border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-600 transition hover:bg-rose-50"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>

                                                <div class="grid gap-3">
                                                    <input
                                                        x-model="project.name"
                                                        type="text"
                                                        placeholder="Project name"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >
                                                    <input
                                                        x-model="project.link"
                                                        type="url"
                                                        placeholder="Project link"
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >
                                                    <textarea
                                                        x-model="project.description"
                                                        rows="4"
                                                        placeholder="Describe the project, your role and the outcome."
                                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    ></textarea>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Languages</h3>
                                    <p class="mt-1 text-sm text-slate-500">Separate each language with a comma.</p>
                                    <textarea
                                        x-model="languages"
                                        rows="3"
                                        placeholder="Example: English, Swahili, French"
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Certifications</h3>
                                    <p class="mt-1 text-sm text-slate-500">Separate each certification with a comma.</p>
                                    <textarea
                                        x-model="certifications"
                                        rows="3"
                                        placeholder="Example: Google Data Analytics Certificate, First Aid Training"
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Resume Quality Score</h2>
                                    <p class="mt-1 text-sm text-slate-500">A smarter ATS-oriented guide to strengthen your document.</p>
                                </div>

                                <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-900">
                                    <span x-text="atsScore"></span>/100
                                </div>
                            </div>

                            <div class="mt-5">
                                <div class="h-3 overflow-hidden rounded-full bg-slate-200">
                                    <div class="h-full rounded-full transition-all duration-300" :class="scoreColor" :style="{ width: scoreWidth }"></div>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-slate-700">
                                    Current rating:
                                    <span x-text="scoreLabel"></span>
                                </p>
                            </div>

                            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Experience Entries</p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900" x-text="completedExperienceCount"></p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Education Entries</p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900" x-text="completedEducationCount"></p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Projects</p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900" x-text="projectCount"></p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Strong Bullet Points</p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900" x-text="strongBulletCount"></p>
                                </div>
                            </div>

                            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">ATS Readiness</p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900" x-text="atsReadinessScore"></p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Job Match Score</p>
                                    <p class="mt-2 text-2xl font-bold text-slate-900" x-text="jobMatchScore"></p>
                                </div>
                            </div>

                            <template x-if="quickTips.length">
                                <div class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 p-4">
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-amber-800">Quick Tips</h3>
                                    <ul class="mt-3 space-y-2 text-sm text-amber-900">
                                        <template x-for="(tip, index) in quickTips" :key="index">
                                            <li class="flex gap-2">
                                                <span>•</span>
                                                <span x-text="tip"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </template>

                            <template x-if="scoreBreakdown.length">
                                <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-800">Score Breakdown</h3>
                                    <div class="mt-3 space-y-3">
                                        <template x-for="(item, index) in scoreBreakdown" :key="index">
                                            <div>
                                                <div class="mb-1 flex items-center justify-between gap-3">
                                                    <span class="text-sm font-medium text-slate-700" x-text="item.label"></span>
                                                    <span class="text-sm font-bold text-slate-900">
                                                        <span x-text="item.score"></span>/<span x-text="item.max"></span>
                                                    </span>
                                                </div>
                                                <div class="h-2 overflow-hidden rounded-full bg-slate-200">
                                                    <div class="h-full rounded-full bg-blue-600" :style="{ width: item.width }"></div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <template x-if="missingKeywords.length">
                                <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 p-4">
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-rose-800">Missing Job Keywords</h3>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <template x-for="(keyword, index) in missingKeywords" :key="index">
                                            <span class="rounded-full border border-rose-200 bg-white px-3 py-1 text-xs font-semibold text-rose-700" x-text="keyword"></span>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <template x-if="improvementSuggestions.length">
                                <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-emerald-800">Smart Suggestions</h3>
                                    <ul class="mt-3 space-y-2 text-sm text-emerald-900">
                                        <template x-for="(tip, index) in improvementSuggestions" :key="index">
                                            <li class="flex gap-2">
                                                <span>•</span>
                                                <span x-text="tip"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </template>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <button
                                    type="button"
                                    @click="copyResume()"
                                    class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    <span x-show="!copied">Copy Resume</span>
                                    <span x-show="copied" style="display:none;">Copied</span>
                                </button>

                                <button
                                    type="button"
                                    @click="printResume()"
                                    class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    Print
                                </button>

                                <button
                                    type="button"
                                    @click="downloadPdf()"
                                    :disabled="downloading || hasValidationErrors"
                                    class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-70"
                                >
                                    <span x-show="!downloading">Download PDF</span>
                                    <span x-show="downloading" style="display:none;">Preparing PDF...</span>
                                </button>

                                <button
                                    type="button"
                                    @click="clearAll()"
                                    class="inline-flex items-center justify-center rounded-2xl border border-rose-200 px-4 py-3 text-sm font-semibold text-rose-600 transition hover:bg-rose-50"
                                >
                                    Clear All
                                </button>
                            </div>

                            <template x-if="hasValidationErrors">
                                <div class="mt-4 rounded-2xl border border-rose-200 bg-rose-50 p-4">
                                    <p class="text-sm font-medium text-rose-700">
                                        Please fix the highlighted contact fields before downloading your PDF.
                                    </p>
                                </div>
                            </template>
                        </section>
                    </div>
                </aside>

                <div class="w-full lg:col-span-7">
                    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm print:rounded-none print:border-0 print:shadow-none">
                        <div class="border-b border-slate-200 px-4 py-4 sm:px-6 lg:px-8 print:hidden">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">Live Preview</h2>
                                    <p class="mt-1 text-sm text-slate-500">Your resume updates automatically as you type.</p>
                                </div>

                                <div
                                    x-show="downloading"
                                    x-transition
                                    class="rounded-2xl border border-blue-200 bg-blue-50 px-4 py-2 text-sm font-medium text-blue-800"
                                    style="display:none;"
                                >
                                    Building your PDF. Please keep this page open.
                                </div>
                            </div>
                        </div>

                        <div class="p-4 sm:p-6 lg:p-8 print:p-0">
                            <div
                                id="resume-preview"
                                class="mx-auto min-h-[1123px] max-w-[850px] rounded-[28px] border border-slate-200 bg-white p-6 text-slate-800 shadow-sm sm:p-10 print:min-h-0 print:max-w-none print:rounded-none print:border-0 print:p-8 print:shadow-none"
                                :class="selectedTemplate === 'clean' ? 'font-sans' : 'font-serif'"
                            >
                                <header class="border-b border-slate-200 pb-6">
                                    <h2 class="text-3xl font-bold tracking-tight text-slate-950" x-text="personal.fullName || 'Your Name'"></h2>

                                    <p class="mt-2 text-base font-medium text-blue-700" x-text="personal.jobTitle || 'Professional Title'"></p>

                                    <div class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-sm text-slate-600">
                                        <template x-if="personal.email">
                                            <span x-text="personal.email"></span>
                                        </template>

                                        <template x-if="personal.phone">
                                            <span x-text="personal.phone"></span>
                                        </template>

                                        <template x-if="fullLocation">
                                            <span x-text="fullLocation"></span>
                                        </template>

                                        <template x-if="personal.website">
                                            <span x-text="personal.website"></span>
                                        </template>

                                        <template x-if="personal.linkedin">
                                            <span x-text="personal.linkedin"></span>
                                        </template>
                                    </div>
                                </header>

                                <template x-if="summary.trim()">
                                    <section class="resume-section mt-8">
                                        <h3 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-500">Professional Summary</h3>
                                        <p class="mt-4 leading-7 text-slate-700" x-text="summary"></p>
                                    </section>
                                </template>

                                <template x-if="skillsList.length">
                                    <section class="resume-section mt-8">
                                        <h3 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-500">Skills</h3>
                                        <div class="mt-4 flex flex-wrap gap-2">
                                            <template x-for="(skill, index) in skillsList" :key="index">
                                                <span class="rounded-full bg-slate-100 px-3 py-1.5 text-sm text-slate-700" x-text="skill"></span>
                                            </template>
                                        </div>
                                    </section>
                                </template>

                                <template x-if="completedExperienceCount">
                                    <section class="resume-section mt-8">
                                        <h3 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-500">Work Experience</h3>

                                        <div class="mt-4 space-y-6">
                                            <template x-for="(job, index) in experience" :key="index">
                                                <template x-if="job.role || job.company">
                                                    <div class="resume-block">
                                                        <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                                            <div>
                                                                <h4 class="text-base font-bold text-slate-900">
                                                                    <span x-text="job.role || 'Job Title'"></span>
                                                                </h4>
                                                                <p class="mt-1 text-slate-700">
                                                                    <span x-text="job.company || 'Company'"></span>
                                                                    <span x-show="job.location"> · </span>
                                                                    <span x-text="job.location || ''"></span>
                                                                </p>
                                                            </div>

                                                            <p class="text-sm text-slate-500">
                                                                <span x-text="job.startDate || ''"></span>
                                                                <span x-show="job.startDate || job.endDate || job.current"> - </span>
                                                                <span x-text="job.current ? 'Present' : (job.endDate || '')"></span>
                                                            </p>
                                                        </div>

                                                        <template x-if="bulletLines(job.bullets).length">
                                                            <ul class="mt-3 space-y-2 text-slate-700">
                                                                <template x-for="(bullet, bulletIndex) in bulletLines(job.bullets)" :key="bulletIndex">
                                                                    <li class="flex gap-3">
                                                                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-slate-400"></span>
                                                                        <span x-text="bullet"></span>
                                                                    </li>
                                                                </template>
                                                            </ul>
                                                        </template>
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                    </section>
                                </template>

                                <template x-if="completedEducationCount">
                                    <section class="resume-section mt-8">
                                        <h3 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-500">Education</h3>

                                        <div class="mt-4 space-y-5">
                                            <template x-for="(item, index) in education" :key="index">
                                                <template x-if="item.school || item.degree">
                                                    <div class="resume-block">
                                                        <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                                            <div>
                                                                <h4 class="text-base font-bold text-slate-900">
                                                                    <span x-text="item.degree || 'Degree'"></span>
                                                                    <span x-show="item.field">, </span>
                                                                    <span x-text="item.field || ''"></span>
                                                                </h4>
                                                                <p class="mt-1 text-slate-700" x-text="item.school || 'School'"></p>
                                                            </div>

                                                            <p class="text-sm text-slate-500">
                                                                <span x-text="item.startDate || ''"></span>
                                                                <span x-show="item.startDate || item.endDate"> - </span>
                                                                <span x-text="item.endDate || ''"></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                    </section>
                                </template>

                                <template x-if="projectCount">
                                    <section class="resume-section mt-8">
                                        <h3 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-500">Projects</h3>

                                        <div class="mt-4 space-y-5">
                                            <template x-for="(project, index) in projects" :key="index">
                                                <template x-if="project.name || project.description">
                                                    <div class="resume-block">
                                                        <h4 class="text-base font-bold text-slate-900" x-text="project.name || 'Project'"></h4>
                                                        <p class="mt-1 text-sm text-blue-700" x-show="project.link" x-text="project.link"></p>
                                                        <p class="mt-2 leading-7 text-slate-700" x-text="project.description || ''"></p>
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                    </section>
                                </template>

                                <div class="mt-8 grid gap-8 sm:grid-cols-2">
                                    <template x-if="languageList.length">
                                        <section class="resume-section">
                                            <h3 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-500">Languages</h3>
                                            <div class="mt-3 space-y-2">
                                                <template x-for="(language, index) in languageList" :key="index">
                                                    <p class="text-slate-700" x-text="language"></p>
                                                </template>
                                            </div>
                                        </section>
                                    </template>

                                    <template x-if="certificationList.length">
                                        <section class="resume-section">
                                            <h3 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-500">Certifications</h3>
                                            <div class="mt-3 space-y-2">
                                                <template x-for="(cert, index) in certificationList" :key="index">
                                                    <p class="text-slate-700" x-text="cert"></p>
                                                </template>
                                            </div>
                                        </section>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="mt-6 grid gap-6 print:hidden">
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
                            <h2 class="text-2xl font-bold text-slate-900">How to use this resume builder</h2>
                            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <h3 class="text-base font-semibold text-slate-900">1. Add your core details</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        Start with your name, target role, contact details and a clear professional summary.
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <h3 class="text-base font-semibold text-slate-900">2. Highlight measurable impact</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        For each job, include bullet points that show results, responsibilities and relevant achievements.
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <h3 class="text-base font-semibold text-slate-900">3. Match your target role</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        Paste the job description and use the keyword and ATS suggestions to improve alignment.
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <h3 class="text-base font-semibold text-slate-900">4. Export when ready</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        Review the live preview, improve your score, and download your resume as a polished PDF.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div x-data="{ openFaq: 1 }" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="text-2xl font-bold text-slate-900">Frequently asked questions</h2>
                                    <p class="mt-2 text-sm text-slate-500">Tap a question to view the answer.</p>
                                </div>
                            </div>

                            <div class="mt-6 space-y-3">
                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <button
                                        type="button"
                                        @click="openFaq = openFaq === 1 ? 0 : 1"
                                        class="flex w-full items-center justify-between gap-4 bg-white px-5 py-4 text-left"
                                    >
                                        <span class="text-base font-semibold text-slate-900">Is this resume builder free to use?</span>
                                        <span class="text-slate-500" x-text="openFaq === 1 ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="openFaq === 1" x-collapse class="border-t border-slate-200 bg-slate-50 px-5 py-4">
                                        <p class="text-sm leading-6 text-slate-600">
                                            Yes. You can create, preview, print and download your resume directly in your browser.
                                        </p>
                                    </div>
                                </div>

                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <button
                                        type="button"
                                        @click="openFaq = openFaq === 2 ? 0 : 2"
                                        class="flex w-full items-center justify-between gap-4 bg-white px-5 py-4 text-left"
                                    >
                                        <span class="text-base font-semibold text-slate-900">Can I use this for ATS-friendly resumes?</span>
                                        <span class="text-slate-500" x-text="openFaq === 2 ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="openFaq === 2" x-collapse class="border-t border-slate-200 bg-slate-50 px-5 py-4">
                                        <p class="text-sm leading-6 text-slate-600">
                                            Yes. The layout is designed to stay clean and readable, with clear headings and structured sections.
                                        </p>
                                    </div>
                                </div>

                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <button
                                        type="button"
                                        @click="openFaq = openFaq === 3 ? 0 : 3"
                                        class="flex w-full items-center justify-between gap-4 bg-white px-5 py-4 text-left"
                                    >
                                        <span class="text-base font-semibold text-slate-900">Does the job description tool improve my resume?</span>
                                        <span class="text-slate-500" x-text="openFaq === 3 ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="openFaq === 3" x-collapse class="border-t border-slate-200 bg-slate-50 px-5 py-4">
                                        <p class="text-sm leading-6 text-slate-600">
                                            It helps you identify missing keywords and improve relevance for the role you are targeting.
                                        </p>
                                    </div>
                                </div>

                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <button
                                        type="button"
                                        @click="openFaq = openFaq === 4 ? 0 : 4"
                                        class="flex w-full items-center justify-between gap-4 bg-white px-5 py-4 text-left"
                                    >
                                        <span class="text-base font-semibold text-slate-900">What should I include in a strong resume?</span>
                                        <span class="text-slate-500" x-text="openFaq === 4 ? '−' : '+'"></span>
                                    </button>
                                    <div x-show="openFaq === 4" x-collapse class="border-t border-slate-200 bg-slate-50 px-5 py-4">
                                        <p class="text-sm leading-6 text-slate-600">
                                            A strong resume usually includes personal details, a concise summary, work experience, education, relevant skills and optional supporting sections such as projects or certifications.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm lg:p-8">
                            <h2 class="text-2xl font-bold text-slate-900">Related tools</h2>

                            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                                <a href="{{ url('/tools/cv-builder') }}" class="rounded-2xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/40">
                                    <h3 class="text-base font-semibold text-slate-900">CV Builder</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        Create a more detailed academic or professional CV with advanced sections.
                                    </p>
                                </a>

                                <a href="{{ url('/tools/word-counter') }}" class="rounded-2xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/40">
                                    <h3 class="text-base font-semibold text-slate-900">Word Counter</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        Check word count, character count and content length before finalizing your application.
                                    </p>
                                </a>

                                <a href="{{ url('/tools/text-case-converter') }}" class="rounded-2xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/40">
                                    <h3 class="text-base font-semibold text-slate-900">Text Case Converter</h3>
                                    <p class="mt-2 text-sm leading-6 text-slate-600">
                                        Quickly clean headings, summaries and bullet text with different case styles.
                                    </p>
                                </a>
                            </div>
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
    'pageSlug' => 'resume-builder',
    'comments' => $comments ?? collect()
])

@endsection

@push('styles')
<style>
    [x-cloak] {
        display: none !important;
    }

    @media print {
        body {
            background: #ffffff !important;
        }

        header,
        footer,
        .print\:hidden {
            display: none !important;
        }

        .resume-section,
        .resume-block {
            break-inside: avoid;
            page-break-inside: avoid;
        }
    }
</style>
@endpush

@push('scripts')
    @vite('resources/js/tools/resume-builder.js')
@endpush