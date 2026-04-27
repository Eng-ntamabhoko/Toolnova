@extends('layouts.app')

@section('title', 'Age Calculator - ToolNova')
@section('meta_description', 'Calculate exact age in years, months, days, hours, minutes and seconds with ToolNova Age Calculator.')

@section('content')
<div x-data="ageCalculator()" x-init="init()" data-tool-slug="age-calculator" class="bg-slate-50">

    <!-- Hero -->
    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 via-slate-950 to-cyan-500/10"></div>
        <div class="absolute -top-24 left-1/2 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-blue-200">
                    Free Online Tool
                </span>

                <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-white sm:text-5xl">
                    Age Calculator
                </h1>

                <p class="mt-4 max-w-2xl text-lg leading-8 text-slate-300">
                    Find exact age in years, months and days, check total time lived, and view useful birthday insights in seconds.
                </p>
            </div>
        </div>
    </section>

    <!-- Tool Area -->
    <section class="py-10 sm:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-12">

                <!-- Form Panel -->
                <aside class="lg:col-span-4">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 6h15A1.5 1.5 0 0 1 21 7.5v10.5a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 18V7.5A1.5 1.5 0 0 1 4.5 6Z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">Calculate age</h2>
                                <p class="text-sm text-slate-500">Enter the details below.</p>
                            </div>
                        </div>

                        <div class="mt-8 space-y-5">
                            <div>
                                <label for="birth_date" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Date of Birth
                                </label>
                                <input
                                    id="birth_date"
                                    type="date"
                                    x-model="birthDate"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                            </div>

                            <div>
                                <label for="as_of_date" class="mb-2 block text-sm font-semibold text-slate-700">
                                    Calculate Age On
                                </label>
                                <input
                                    id="as_of_date"
                                    type="date"
                                    x-model="asOfDate"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="sex" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Sex
                                    </label>
                                    <select
                                        id="sex"
                                        x-model="sex"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    >
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="mode" class="mb-2 block text-sm font-semibold text-slate-700">
                                        Estimate Mode
                                    </label>
                                    <select
                                        id="mode"
                                        x-model="country"
                                        class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    >
                                        <option value="tanzania">Tanzania</option>
                                        <option value="general">General</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <button
                                    type="button"
                                    @click="calculate()"
                                    class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3.5 font-semibold text-white transition hover:bg-blue-700"
                                >
                                    Calculate
                                </button>

                                <button
                                    type="button"
                                    @click="resetForm()"
                                    class="inline-flex items-center justify-center rounded-2xl border border-slate-300 px-6 py-3.5 font-semibold text-slate-700 transition hover:bg-slate-100"
                                >
                                    Reset
                                </button>
                            </div>

                            <div
                                x-show="error"
                                x-transition
                                class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                            >
                                <span x-text="error"></span>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-4 text-sm leading-6 text-slate-600">
                                Use this tool to calculate age as of today or any selected date after birth.
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Results Panel -->
                <div class="lg:col-span-8 space-y-8">

                    <!-- Summary -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">Age Summary</h2>
                                <p class="mt-1 text-slate-500">Your exact age breakdown.</p>
                            </div>

                            <div class="flex flex-wrap items-center gap-3">
                                <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                                    <span x-text="resultReady ? 'Calculated' : 'Waiting for input'"></span>
                                </div>

                                <button
                                    type="button"
                                    @click="copyResult()"
                                    :disabled="!resultReady"
                                    class="rounded-2xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 disabled:cursor-not-allowed disabled:opacity-50"
                                >
                                    <span x-text="copied ? 'Copied' : 'Copy'"></span>
                                </button>

                                <button
                                    type="button"
                                    @click="shareResult()"
                                    :disabled="!resultReady"
                                    class="rounded-2xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 disabled:cursor-not-allowed disabled:opacity-50"
                                >
                                    Share
                                </button>

                                <button
                                    type="button"
                                    @click="printResult()"
                                    :disabled="!resultReady"
                                    class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-600 disabled:cursor-not-allowed disabled:opacity-50"
                                >
                                    Print
                                </button>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                            <div class="rounded-2xl bg-blue-50 p-5">
                                <p class="text-sm font-medium text-blue-700">Years</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="result.years ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl bg-emerald-50 p-5">
                                <p class="text-sm font-medium text-emerald-700">Months</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="result.months ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl bg-amber-50 p-5">
                                <p class="text-sm font-medium text-amber-700">Days</p>
                                <p class="mt-2 text-3xl font-extrabold text-slate-900" x-text="result.days ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl bg-violet-50 p-5">
                                <p class="text-sm font-medium text-violet-700">Born On</p>
                                <p class="mt-2 text-lg font-bold text-slate-900" x-text="birthWeekday || '--'"></p>
                            </div>
                        </div>

                        <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                            <template x-if="resultReady">
                                <p class="text-lg text-slate-800">
                                    You are
                                    <strong x-text="result.years"></strong> years,
                                    <strong x-text="result.months"></strong> months and
                                    <strong x-text="result.days"></strong> days old.
                                </p>
                            </template>

                            <template x-if="!resultReady">
                                <p class="text-slate-500">
                                    The full age statement will appear here after calculation.
                                </p>
                            </template>
                        </div>
                    </section>

                    <!-- Totals -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h2 class="text-2xl font-bold text-slate-900">Total Time Lived</h2>
                        <p class="mt-1 text-slate-500">Detailed totals from birth date to selected date.</p>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Total Months</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="totals.totalMonths ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Total Weeks</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="totals.totalWeeks ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Total Days</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="totals.totalDays ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Total Hours</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="totals.totalHours ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Total Minutes</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="totals.totalMinutes ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Total Seconds</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="totals.totalSeconds ?? '--'"></p>
                            </div>
                        </div>
                    </section>

                    <!-- Insights -->
                    <div class="grid gap-8 lg:grid-cols-2">
                        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                            <h2 class="text-2xl font-bold text-slate-900">Birthday Insights</h2>

                            <div class="mt-6 space-y-4">
                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-sm font-medium text-slate-500">Next Birthday</p>
                                    <p class="mt-1 text-lg font-bold text-slate-900" x-text="nextBirthdayDate || '--'"></p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-sm font-medium text-slate-500">Next Birthday Weekday</p>
                                    <p class="mt-1 text-lg font-bold text-slate-900" x-text="nextBirthdayWeekday || '--'"></p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-sm font-medium text-slate-500">Days Until Next Birthday</p>
                                    <p class="mt-1 text-lg font-bold text-slate-900" x-text="daysUntilBirthday ?? '--'"></p>
                                </div>
                            </div>
                        </section>

                        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                            <h2 class="text-2xl font-bold text-slate-900">Life Milestones</h2>

                            <div class="mt-6 space-y-4">
                                <template x-for="milestone in milestones" :key="milestone.label">
                                    <div class="rounded-2xl border border-slate-200 p-4">
                                        <div class="flex items-center justify-between gap-3">
                                            <p class="font-semibold text-slate-900" x-text="milestone.label"></p>
                                            <span
                                                class="rounded-full px-3 py-1 text-xs font-semibold"
                                                :class="milestone.hit ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600'"
                                                x-text="milestone.hit ? 'Reached' : 'Upcoming'"
                                            ></span>
                                        </div>
                                        <p class="mt-2 text-sm text-slate-600" x-text="milestone.text"></p>
                                    </div>
                                </template>
                            </div>
                        </section>
                    </div>

                    <!-- Survival -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">Average Survival Outlook</h2>
                                <p class="mt-1 text-slate-500">Population-based estimate</p>
                            </div>

                            <span class="rounded-full bg-blue-100 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-blue-700">
                                Working now
                            </span>
                        </div>

                        <div class="mt-6 rounded-2xl border border-blue-200 bg-blue-50 p-5 text-sm leading-7 text-blue-900">
                            These estimates are based on a simple local population model using age band data and selected mode.
                            They are useful for general guidance, not a medical or personal prediction.
                        </div>

                        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                            <div class="rounded-2xl bg-slate-50 p-5">
                                <p class="text-sm font-medium text-slate-500">Estimated Remaining Years</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="survival.estimatedRemainingYears ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-5">
                                <p class="text-sm font-medium text-slate-500">Estimated Lifespan Age</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="survival.estimatedLifespanAge ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-5">
                                <p class="text-sm font-medium text-slate-500">Chance of Reaching 80</p>
                                <p class="mt-2 text-2xl font-bold text-slate-900" x-text="survival.probReach80 ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 p-5">
                                <p class="text-sm font-medium text-slate-500">Selected Mode</p>
                                <p class="mt-2 text-2xl font-bold capitalize text-slate-900" x-text="country"></p>
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 md:grid-cols-3">
                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Chance of Reaching 60</p>
                                <p class="mt-2 text-xl font-bold text-slate-900" x-text="survival.probReach60 ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Chance of Reaching 70</p>
                                <p class="mt-2 text-xl font-bold text-slate-900" x-text="survival.probReach70 ?? '--'"></p>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-5">
                                <p class="text-sm font-medium text-slate-500">Chance of Reaching 90</p>
                                <p class="mt-2 text-xl font-bold text-slate-900" x-text="survival.probReach90 ?? '--'"></p>
                            </div>
                        </div>
                    </section>

                    <!-- How to Use Accordion -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <button
                            type="button"
                            @click="openHowTo = !openHowTo"
                            class="flex w-full items-center justify-between gap-4 text-left"
                        >
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">How to Use</h2>
                                <p class="mt-1 text-slate-500">Click to view the steps.</p>
                            </div>

                            <div class="rounded-2xl bg-slate-100 p-3 text-slate-700">
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
                                <li><strong class="text-slate-900">1.</strong> Select the date of birth.</li>
                                <li><strong class="text-slate-900">2.</strong> Choose the date you want to calculate age on.</li>
                                <li><strong class="text-slate-900">3.</strong> Select sex and estimate mode if you want the survival outlook section to update.</li>
                                <li><strong class="text-slate-900">4.</strong> Click the Calculate button or simply change the fields to update automatically.</li>
                                <li><strong class="text-slate-900">5.</strong> Review exact age, total time lived, birthday details and milestone progress.</li>
                            </ol>
                        </div>
                    </section>

                    <!-- Why Use -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <h2 class="text-2xl font-bold text-slate-900">Why Use This Tool</h2>
                        <p class="mt-5 leading-7 text-slate-600">
                            This age calculator helps with school records, job applications, official forms, planning,
                            birthday tracking and general personal use.
                        </p>
                    </section>

                    <!-- FAQ Accordion -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">Frequently Asked Questions</h2>
                            <p class="mt-1 text-slate-500">Tap a question to view the answer.</p>
                        </div>

                        <div class="mt-6 space-y-4">
                            <template x-for="(item, index) in faqItems" :key="index">
                                <div class="overflow-hidden rounded-2xl border border-slate-200">
                                    <button
                                        type="button"
                                        @click="toggleFaq(index)"
                                        class="flex w-full items-center justify-between gap-4 bg-white px-5 py-4 text-left"
                                    >
                                        <span class="font-semibold text-slate-900" x-text="item.q"></span>

                                        <span class="rounded-full bg-slate-100 p-2 text-slate-700">
                                            <svg x-show="openFaq !== index" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            <svg x-show="openFaq === index" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                            </svg>
                                        </span>
                                    </button>

                                    <div x-show="openFaq === index" x-transition class="border-t border-slate-200 bg-slate-50 px-5 py-4 text-slate-600">
                                        <p x-text="item.a"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </section>

                    <!-- SEO Rich Related Content -->
                    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-slate-900">Related Age and Date Tools</h2>
                                <p class="mt-1 text-slate-500">
                                    Explore more useful tools for calculations, dates and everyday tasks.
                                </p>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                            <a href="{{ url('/tools/word-counter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Word Counter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Count words, characters and sentences instantly for essays, articles and documents.
                                </p>
                            </a>

                            <a href="{{ url('/tools/password-generator') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">Password Generator</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Create strong and secure passwords for online accounts, apps and business tools.
                                </p>
                            </a>

                            <a href="{{ url('/tools/json-formatter') }}" class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-300 hover:bg-blue-50/40">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700">JSON Formatter</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">
                                    Format and beautify JSON data quickly for development and debugging tasks.
                                </p>
                            </a>
                        </div>

                        <div class="mt-10 grid gap-8 lg:grid-cols-2">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">When an age calculator is useful</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    An age calculator can be useful for school admission checks, job applications,
                                    official records, retirement planning, birthday preparation and date-based comparisons.
                                    It helps users get exact age values without manual counting.
                                </p>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-slate-900">What this tool can show</h3>
                                <p class="mt-3 leading-7 text-slate-600">
                                    This tool shows exact age in years, months and days, total time lived in larger and smaller units,
                                    next birthday timing, milestone tracking and a simple population-based survival outlook for extra context.
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
