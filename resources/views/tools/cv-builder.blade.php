@extends('layouts.app')

@section('title', 'CV Builder Tanzania - Create Professional CV Online | ToolNova')
@section('meta_description', 'Create a formal Tanzania-style curriculum vitae online with ToolNova. Fill your details, preview instantly, and download as PDF or Word.')
@section('meta_keywords', 'cv builder tanzania, mfano wa cv, cv ya kazi, curriculum vitae format, tanzania cv format, cv template tanzania, online cv builder')

@section('content')
<div x-data="cvBuilder(@json($cv->cv_data ?? []), @json(auth()->check()))" class="bg-slate-50 overflow-x-hidden">

    <section class="relative overflow-hidden bg-slate-950 print:hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(59,130,246,0.22),transparent_35%),radial-gradient(circle_at_bottom_right,rgba(14,165,233,0.18),transparent_30%)]"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-slate-200">
                    Tanzania CV Builder
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Create a formal local CV online
                </h1>

                <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Tumia ToolNova kutengeneza <strong class="font-semibold text-white">curriculum vitae</strong> ya format inayotumika Tanzania. Jaza taarifa zako, preview moja kwa moja, kisha pakua kama <strong class="font-semibold text-white">PDF</strong> au <strong class="font-semibold text-white">Word</strong>.
                </p>

                <div class="mt-6 flex flex-wrap gap-3 text-xs sm:text-sm">
                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-slate-200">Personal Details</span>
                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-slate-200">Education Background</span>
                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-slate-200">Working Experience</span>
                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-slate-200">Declaration & Signature</span>
                </div>
            </div>
        </div>
    </section>

    <section class="border-b border-slate-200 bg-white print:hidden">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h2 class="text-lg font-bold text-slate-900">Formal local format</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Hii builder imepangwa kwa mtiririko wa local CV: personal details, contacts, education, experience, ability, referees na declaration.
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h2 class="text-lg font-bold text-slate-900">Simple and realistic</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Hakuna format ya kisasa isiyohitajika. Inakaa kama CV ya kawaida inayotumika kwenye applications nyingi za Tanzania.
                    </p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h2 class="text-lg font-bold text-slate-900">Ready to save or download</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Unaweza kuhifadhi kwenye account yako na pia kupakua file kwa matumizi ya kazi, internship, NGO, school au office applications.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6 sm:py-10 print:py-0">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 print:max-w-none print:px-0">
            <div class="flex flex-col gap-6 lg:grid lg:grid-cols-12 lg:gap-8 print:block">

                <aside class="w-full lg:col-span-5 print:hidden">
                    <div class="space-y-6">

                        <template x-if="notice.show">
                            <div
                                class="rounded-3xl border p-4 shadow-sm sm:p-5"
                                :class="{
                                    'border-blue-200 bg-blue-50': notice.type === 'info',
                                    'border-emerald-200 bg-emerald-50': notice.type === 'success',
                                    'border-rose-200 bg-rose-50': notice.type === 'error',
                                    'border-amber-200 bg-amber-50': notice.type === 'warning'
                                }"
                            >
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3
                                            class="text-sm font-bold uppercase tracking-wide"
                                            :class="{
                                                'text-blue-800': notice.type === 'info',
                                                'text-emerald-800': notice.type === 'success',
                                                'text-rose-800': notice.type === 'error',
                                                'text-amber-800': notice.type === 'warning'
                                            }"
                                            x-text="notice.title"
                                        ></h3>

                                        <p
                                            class="mt-2 text-sm leading-6"
                                            :class="{
                                                'text-blue-900': notice.type === 'info',
                                                'text-emerald-900': notice.type === 'success',
                                                'text-rose-900': notice.type === 'error',
                                                'text-amber-900': notice.type === 'warning'
                                            }"
                                            x-text="notice.message"
                                        ></p>
                                    </div>

                                    <button
                                        type="button"
                                        @click="hideNotice()"
                                        class="rounded-full border border-current/10 px-3 py-1 text-xs font-semibold text-slate-600 hover:bg-white/60"
                                    >
                                        Close
                                    </button>
                                </div>
                            </div>
                        </template>

                        <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6 lg:p-8">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                <div>
                                    <h2 class="text-lg font-bold text-slate-900 sm:text-2xl">CV Editor</h2>
                                    <p class="mt-1 text-sm text-slate-500">Jaza taarifa zako kwenye format ya kawaida ya Tanzania.</p>
                                </div>

                                <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">
                                    Local TZ CV
                                </div>
                            </div>

                            <div class="mt-6 space-y-6">

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Personal Details</h3>
                                    <div class="mt-3 grid gap-3">
                                        <div class="grid gap-3 sm:grid-cols-2">
                                            <div>
                                                <input
                                                    x-model="personal.surname"
                                                    type="text"
                                                    placeholder="Surname *"
                                                    class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                    :class="errors.surname ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                                >
                                                <p x-show="errors.surname" x-text="errors.surname" class="mt-1 text-xs text-rose-600"></p>
                                            </div>

                                            <div>
                                                <input
                                                    x-model="personal.firstName"
                                                    type="text"
                                                    placeholder="First Name *"
                                                    class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                    :class="errors.firstName ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                                >
                                                <p x-show="errors.firstName" x-text="errors.firstName" class="mt-1 text-xs text-rose-600"></p>
                                            </div>
                                        </div>

                                        <input
                                            x-model="personal.otherNames"
                                            type="text"
                                            placeholder="Other Names"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                        >

                                        <div class="grid gap-3 sm:grid-cols-2">
                                            <input
                                                x-model="personal.sex"
                                                type="text"
                                                placeholder="Sex"
                                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                            >

                                            <input
                                                x-model="personal.maritalStatus"
                                                type="text"
                                                placeholder="Marital Status"
                                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                            >
                                        </div>

                                        <div class="grid gap-3 sm:grid-cols-2">
                                            <input
                                                x-model="personal.birthDate"
                                                type="text"
                                                placeholder="Birth Date"
                                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                            >

                                            <input
                                                x-model="personal.nationality"
                                                type="text"
                                                placeholder="Nationality"
                                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Contact Details</h3>
                                    <div class="mt-3 grid gap-3">
                                        <div>
                                            <input
                                                x-model="contact.address"
                                                type="text"
                                                placeholder="Address *"
                                                class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                :class="errors.address ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                            >
                                            <p x-show="errors.address" x-text="errors.address" class="mt-1 text-xs text-rose-600"></p>
                                        </div>

                                        <div class="grid gap-3 sm:grid-cols-2">
                                            <div>
                                                <input
                                                    x-model="contact.mobile1"
                                                    type="text"
                                                    placeholder="Mobile Number 1 *"
                                                    class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                    :class="errors.mobile1 ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                                >
                                                <p x-show="errors.mobile1" x-text="errors.mobile1" class="mt-1 text-xs text-rose-600"></p>
                                            </div>

                                            <div>
                                                <input
                                                    x-model="contact.mobile2"
                                                    type="text"
                                                    placeholder="Mobile Number 2"
                                                    class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                    :class="errors.mobile2 ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                                >
                                                <p x-show="errors.mobile2" x-text="errors.mobile2" class="mt-1 text-xs text-rose-600"></p>
                                            </div>
                                        </div>

                                        <div>
                                            <input
                                                x-model="contact.email"
                                                type="email"
                                                placeholder="Email Address *"
                                                class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                                :class="errors.email ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                            >
                                            <p x-show="errors.email" x-text="errors.email" class="mt-1 text-xs text-rose-600"></p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Education Background</h3>
                                        <button
                                            type="button"
                                            @click="addEducation()"
                                            class="rounded-2xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100"
                                        >
                                            Add Education
                                        </button>
                                    </div>

                                    <div class="mt-3 space-y-3">
                                        <template x-for="(edu, index) in education" :key="index">
                                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                                <div class="grid gap-3">
                                                    <div class="grid gap-3 sm:grid-cols-2">
                                                        <input
                                                            x-model="edu.year"
                                                            type="text"
                                                            placeholder="Year / Period"
                                                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >
                                                        <input
                                                            x-model="edu.institution"
                                                            type="text"
                                                            placeholder="Institution / School"
                                                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >
                                                    </div>

                                                    <textarea
                                                        x-model="edu.awardCourse"
                                                        rows="2"
                                                        placeholder="Award / Course / Combination"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    ></textarea>
                                                </div>

                                                <div class="mt-3 flex justify-end">
                                                    <button
                                                        type="button"
                                                        @click="removeEducation(index)"
                                                        class="rounded-2xl border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-50"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Working Experience</h3>
                                        <button
                                            type="button"
                                            @click="addExperience()"
                                            class="rounded-2xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100"
                                        >
                                            Add Experience
                                        </button>
                                    </div>

                                    <div class="mt-3 space-y-3">
                                        <template x-for="(exp, index) in experience" :key="index">
                                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                                <div class="grid gap-3">
                                                    <input
                                                        x-model="exp.period"
                                                        type="text"
                                                        placeholder="Period"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >

                                                    <div class="grid gap-3 sm:grid-cols-2">
                                                        <input
                                                            x-model="exp.title"
                                                            type="text"
                                                            placeholder="Job Title"
                                                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >

                                                        <input
                                                            x-model="exp.organization"
                                                            type="text"
                                                            placeholder="Organization"
                                                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >
                                                    </div>

                                                    <textarea
                                                        x-model="exp.description"
                                                        rows="3"
                                                        placeholder="Description"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    ></textarea>
                                                </div>

                                                <div class="mt-3 flex justify-end">
                                                    <button
                                                        type="button"
                                                        @click="removeExperience(index)"
                                                        class="rounded-2xl border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-50"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Ability / Skills</h3>
                                    <textarea
                                        x-model="skillsText"
                                        rows="4"
                                        placeholder="Write one skill per line or separate with commas"
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Extra Knowledge</h3>
                                    <textarea
                                        x-model="additionalSkillsText"
                                        rows="4"
                                        placeholder="Write one item per line or separate with commas"
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Language Skills</h3>
                                        <button
                                            type="button"
                                            @click="addLanguage()"
                                            class="rounded-2xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100"
                                        >
                                            Add Language
                                        </button>
                                    </div>

                                    <div class="mt-3 space-y-3">
                                        <template x-for="(lang, index) in languages" :key="index">
                                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                                <div class="grid gap-3 sm:grid-cols-2">
                                                    <input
                                                        x-model="lang.language"
                                                        type="text"
                                                        placeholder="Language"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 sm:col-span-2"
                                                    >

                                                    <input
                                                        x-model="lang.reading"
                                                        type="text"
                                                        placeholder="Reading"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >

                                                    <input
                                                        x-model="lang.writing"
                                                        type="text"
                                                        placeholder="Writing"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >

                                                    <input
                                                        x-model="lang.speaking"
                                                        type="text"
                                                        placeholder="Speaking"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 sm:col-span-2"
                                                    >
                                                </div>

                                                <div class="mt-3 flex justify-end">
                                                    <button
                                                        type="button"
                                                        @click="removeLanguage(index)"
                                                        class="rounded-2xl border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-50"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Interest / Hobbies</h3>
                                    <textarea
                                        x-model="interestsText"
                                        rows="4"
                                        placeholder="Write one hobby per line or separate with commas"
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Referees</h3>
                                        <button
                                            type="button"
                                            @click="addReferee()"
                                            class="rounded-2xl border border-slate-300 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-100"
                                        >
                                            Add Referee
                                        </button>
                                    </div>

                                    <div class="mt-3 space-y-3">
                                        <template x-for="(ref, index) in referees" :key="index">
                                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                                <div class="grid gap-3">
                                                    <input
                                                        x-model="ref.name"
                                                        type="text"
                                                        placeholder="Name"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >

                                                    <div class="grid gap-3 sm:grid-cols-2">
                                                        <input
                                                            x-model="ref.title"
                                                            type="text"
                                                            placeholder="Title"
                                                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >

                                                        <input
                                                            x-model="ref.organization"
                                                            type="text"
                                                            placeholder="Organization"
                                                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                        >
                                                    </div>

                                                    <input
                                                        x-model="ref.address"
                                                        type="text"
                                                        placeholder="Address"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >

                                                    <input
                                                        x-model="ref.mobile"
                                                        type="text"
                                                        placeholder="Mobile"
                                                        class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                                    >
                                                </div>

                                                <div class="mt-3 flex justify-end">
                                                    <button
                                                        type="button"
                                                        @click="removeReferee(index)"
                                                        class="rounded-2xl border border-rose-200 px-3 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-50"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Declaration</h3>
                                    <textarea
                                        x-model="declaration"
                                        rows="4"
                                        placeholder="Declaration text"
                                        class="mt-3 w-full rounded-2xl border border-slate-300 px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                    ></textarea>
                                </div>

                                <div>
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Signature & Date</h3>

                                    <div class="mt-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-3">Upload Signature Image</label>
                                        <input
                                            type="file"
                                            accept="image/png,image/jpeg,image/jpg,image/webp"
                                            @change="handleSignatureUpload($event)"
                                            class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-2xl file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-800"
                                        >

                                        <div class="mt-4 flex items-center gap-3">
                                            <input
                                                id="useTodayDate"
                                                type="checkbox"
                                                x-model="useTodayDate"
                                                @change="toggleAutoDate()"
                                                class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                                            >
                                            <label for="useTodayDate" class="text-sm text-slate-700">Use today's date automatically</label>
                                        </div>

                                        <div x-show="!useTodayDate" class="mt-3">
                                            <input
                                                x-model="signatureDate"
                                                type="text"
                                                placeholder="Signature date"
                                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                            >
                                        </div>

                                        <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-4">
                                            <p class="text-sm font-semibold text-slate-800">Signature:</p>

                                            <template x-if="signatureDataUrl">
                                                <img :src="signatureDataUrl" alt="Signature" class="mt-2 max-h-20 max-w-xs rounded border border-slate-300">
                                            </template>

                                            <template x-if="!signatureDataUrl">
                                                <div class="mt-2 h-12 w-56 border-b border-slate-400"></div>
                                            </template>

                                            <p class="mt-4 text-sm font-semibold text-slate-800">
                                                Date:
                                                <span x-text="displaySignatureDate" class="font-normal"></span>
                                            </p>

                                            <button
                                                type="button"
                                                @click="clearSignature()"
                                                class="mt-4 rounded-2xl border border-rose-200 px-4 py-2 text-xs font-semibold text-rose-700 hover:bg-rose-50"
                                            >
                                                Clear Signature
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">Save CV</h3>

                                    <div class="mt-3">
                                        <input
                                            x-model="saveTitle"
                                            type="text"
                                            placeholder="Enter CV title"
                                            class="w-full rounded-2xl border px-4 py-3 outline-none transition"
                                            :class="saveTitleError ? 'border-rose-400 focus:border-rose-500 focus:ring-4 focus:ring-rose-100' : 'border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100'"
                                        >
                                        <p x-show="saveTitleError" x-text="saveTitleError" class="mt-1 text-xs text-rose-600"></p>
                                    </div>

                                    <p class="mt-2 text-xs leading-6 text-slate-500">
                                        Jaza title kama: <span class="font-semibold">Teaching CV 2025</span> au <span class="font-semibold">Office CV Final</span>.
                                    </p>
                                </div>

                                <div class="flex flex-wrap gap-3 pt-2">
                                    <button
                                        type="button"
                                        @click="downloadPdf()"
                                        :disabled="downloading"
                                        class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800 disabled:cursor-not-allowed disabled:opacity-60"
                                    >
                                        <span x-show="!downloading">Download PDF</span>
                                        <span x-show="downloading">Preparing...</span>
                                    </button>

                                    <button
                                        type="button"
                                        @click="downloadWord()"
                                        :disabled="downloading"
                                        class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-800 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-60"
                                    >
                                        Download Word
                                    </button>

                                    <button
                                        type="button"
                                        @click="saveCv()"
                                        :disabled="saving"
                                        class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 px-5 py-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-100 disabled:cursor-not-allowed disabled:opacity-60"
                                    >
                                        <span x-show="!saving">Save CV</span>
                                        <span x-show="saving">Saving...</span>
                                    </button>

                                    <button
                                        type="button"
                                        @click="copyCv()"
                                        class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-800 transition hover:bg-slate-50"
                                    >
                                        Copy Text
                                    </button>

                                    <button
                                        type="button"
                                        @click="printCv()"
                                        class="inline-flex items-center justify-center rounded-2xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-800 transition hover:bg-slate-50"
                                    >
                                        Print
                                    </button>

                                    <button
                                        type="button"
                                        @click="clearAll()"
                                        class="inline-flex items-center justify-center rounded-2xl border border-rose-200 bg-white px-5 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-50"
                                    >
                                        Clear All
                                    </button>
                                </div>
                            </div>
                        </section>
                    </div>
                </aside>

                <div class="w-full lg:col-span-7">
                    <div class="space-y-6">

                        <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm print:hidden">
                            <div class="grid gap-5 md:grid-cols-3">
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Completion</p>
                                    <p class="mt-2 text-lg font-bold text-slate-900" x-text="completionScore + '%'"></p>
                                </div>

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 md:col-span-2">
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">CV Strength</span>
                                        <span class="text-xs font-semibold text-slate-700" x-text="qualityLabel"></span>
                                    </div>
                                    <div class="mt-3 h-3 overflow-hidden rounded-full bg-slate-200">
                                        <div class="h-full rounded-full transition-all duration-300" :class="qualityColor" :style="`width: ${qualityWidth}`"></div>
                                    </div>
                                </div>
                            </div>

                            <template x-if="quickTips.length">
                                <div class="mt-5 rounded-2xl border border-amber-200 bg-amber-50 p-4">
                                    <h3 class="text-sm font-bold uppercase tracking-wide text-amber-800">Quick tips</h3>
                                    <ul class="mt-2 space-y-2 text-sm text-amber-900">
                                        <template x-for="(tip, index) in quickTips" :key="index">
                                            <li class="flex gap-2">
                                                <span>•</span>
                                                <span x-text="tip"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </template>
                        </section>

                        <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8 print:rounded-none print:border-0 print:p-0 print:shadow-none">
                            <div class="cv-preview text-sm leading-7 text-slate-900 print:text-[12px]">

                                <div class="mb-6 text-center">
                                    <h1 class="text-2xl font-bold uppercase tracking-wide print:text-xl">Curriculum Vitae</h1>
                                </div>

                                <div class="mb-5" x-show="hasPersonalInfo">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">1.0 Personal Details</h2>
                                    <table class="w-full text-sm print:text-[12px]">
                                        <tr x-show="personal.surname">
                                            <td class="w-40 font-semibold">Surname</td>
                                            <td>: <span x-text="personal.surname"></span></td>
                                        </tr>
                                        <tr x-show="personal.firstName">
                                            <td class="font-semibold">First Name</td>
                                            <td>: <span x-text="personal.firstName"></span></td>
                                        </tr>
                                        <tr x-show="personal.otherNames">
                                            <td class="font-semibold">Other Names</td>
                                            <td>: <span x-text="personal.otherNames"></span></td>
                                        </tr>
                                        <tr x-show="personal.nationality">
                                            <td class="font-semibold">Nationality</td>
                                            <td>: <span x-text="personal.nationality"></span></td>
                                        </tr>
                                        <tr x-show="personal.birthDate">
                                            <td class="font-semibold">Date of Birth</td>
                                            <td>: <span x-text="personal.birthDate"></span></td>
                                        </tr>
                                        <tr x-show="personal.sex">
                                            <td class="font-semibold">Sex</td>
                                            <td>: <span x-text="personal.sex"></span></td>
                                        </tr>
                                        <tr x-show="personal.maritalStatus">
                                            <td class="font-semibold">Marital Status</td>
                                            <td>: <span x-text="personal.maritalStatus"></span></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="mb-5" x-show="hasContactInfo">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">2.0 Contact Details</h2>
                                    <table class="w-full text-sm print:text-[12px]">
                                        <tr x-show="contact.address">
                                            <td class="w-40 font-semibold">Address</td>
                                            <td>: <span x-text="contact.address"></span></td>
                                        </tr>
                                        <tr x-show="contact.mobile1 || contact.mobile2">
                                            <td class="font-semibold">Mobile Number</td>
                                            <td>: <span x-text="[contact.mobile1, contact.mobile2].filter(Boolean).join(', ')"></span></td>
                                        </tr>
                                        <tr x-show="contact.email">
                                            <td class="font-semibold">E-mail</td>
                                            <td>: <span x-text="contact.email"></span></td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="mb-5" x-show="validEducation.length">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">3.0 Education Background</h2>
                                    <table class="w-full border-collapse border border-slate-300 text-sm print:text-[12px]">
                                        <thead>
                                            <tr class="bg-slate-100">
                                                <th class="border border-slate-300 p-2 text-left font-semibold">Year</th>
                                                <th class="border border-slate-300 p-2 text-left font-semibold">Institution / School</th>
                                                <th class="border border-slate-300 p-2 text-left font-semibold">Award / Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(edu, index) in validEducation" :key="index">
                                                <tr>
                                                    <td class="border border-slate-300 p-2" x-text="edu.year || '-'"></td>
                                                    <td class="border border-slate-300 p-2" x-text="edu.institution || '-'"></td>
                                                    <td class="border border-slate-300 p-2" x-text="edu.awardCourse || '-'"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mb-5" x-show="validExperience.length">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">4.0 Working Experience</h2>
                                    <div class="space-y-4">
                                        <template x-for="(exp, index) in validExperience" :key="index">
                                            <div>
                                                <p class="font-semibold" x-text="exp.period"></p>
                                                <p x-show="exp.title" x-text="exp.title"></p>
                                                <p x-show="exp.organization" x-text="exp.organization"></p>
                                                <p x-show="exp.description" class="mt-1 leading-7" x-text="exp.description"></p>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="mb-5" x-show="skillsList.length">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">5.0 Ability / Skills</h2>
                                    <ol class="list-decimal pl-6">
                                        <template x-for="(skill, index) in skillsList" :key="index">
                                            <li x-text="skill"></li>
                                        </template>
                                    </ol>
                                </div>

                                <div class="mb-5" x-show="additionalSkillsList.length">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">6.0 Extra Knowledge</h2>
                                    <ol class="list-decimal pl-6">
                                        <template x-for="(item, index) in additionalSkillsList" :key="index">
                                            <li x-text="item"></li>
                                        </template>
                                    </ol>
                                </div>

                                <div class="mb-5" x-show="validLanguages.length">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">7.0 Language Skills</h2>
                                    <table class="w-full border-collapse border border-slate-300 text-sm print:text-[12px]">
                                        <thead>
                                            <tr class="bg-slate-100">
                                                <th class="border border-slate-300 p-2 text-left font-semibold">Language</th>
                                                <th class="border border-slate-300 p-2 text-left font-semibold">Reading</th>
                                                <th class="border border-slate-300 p-2 text-left font-semibold">Writing</th>
                                                <th class="border border-slate-300 p-2 text-left font-semibold">Speaking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(lang, index) in validLanguages" :key="index">
                                                <tr>
                                                    <td class="border border-slate-300 p-2" x-text="lang.language || '-'"></td>
                                                    <td class="border border-slate-300 p-2" x-text="lang.reading || '-'"></td>
                                                    <td class="border border-slate-300 p-2" x-text="lang.writing || '-'"></td>
                                                    <td class="border border-slate-300 p-2" x-text="lang.speaking || '-'"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mb-5" x-show="interestsList.length">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">8.0 Interest and Hobbies</h2>
                                    <ol class="list-decimal pl-6">
                                        <template x-for="(interest, index) in interestsList" :key="index">
                                            <li x-text="interest"></li>
                                        </template>
                                    </ol>
                                </div>

                                <div class="mb-5" x-show="validReferees.length">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">9.0 Referees</h2>
                                    <div class="space-y-5">
                                        <template x-for="(ref, index) in validReferees" :key="index">
                                            <div>
                                                <p><span class="font-semibold">Name:</span> <span x-text="ref.name"></span></p>
                                                <p x-show="ref.title"><span class="font-semibold">Title:</span> <span x-text="ref.title"></span></p>
                                                <p x-show="ref.organization"><span class="font-semibold">Organization:</span> <span x-text="ref.organization"></span></p>
                                                <p x-show="ref.address"><span class="font-semibold">Address:</span> <span x-text="ref.address"></span></p>
                                                <p x-show="ref.mobile"><span class="font-semibold">Mobile:</span> <span x-text="ref.mobile"></span></p>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="mb-5" x-show="declaration.trim()">
                                    <h2 class="section-title mb-2 text-base font-bold uppercase print:text-sm">10.0 Declaration</h2>
                                    <p class="leading-7" x-text="declaration"></p>
                                </div>

                                <div class="pt-6" x-show="declaration.trim() || signatureDataUrl || displaySignatureDate">
                                    <div class="grid gap-6 sm:grid-cols-2">
                                        <div>
                                            <p class="mb-2 font-semibold">Signature:</p>
                                            <template x-if="signatureDataUrl">
                                                <img :src="signatureDataUrl" alt="Signature" class="max-h-16 max-w-40">
                                            </template>
                                            <template x-if="!signatureDataUrl">
                                                <div class="h-10 w-48 border-b border-slate-500"></div>
                                            </template>
                                        </div>

                                        <div class="sm:text-right">
                                            <p class="mb-2 font-semibold">Date:</p>
                                            <p x-text="displaySignatureDate"></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="border-t border-slate-200 bg-white print:hidden">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h2 class="text-2xl font-bold text-slate-900">CV Builder FAQ</h2>

                    <div class="mt-6 space-y-5">
                        <div>
                            <h3 class="font-semibold text-slate-900">Je hii ni resume builder au local CV builder?</h3>
                            <p class="mt-2 text-sm leading-7 text-slate-600">
                                Hii imepangwa kama local Tanzania CV builder yenye sections formal kama personal details, education background, working experience, referees na declaration.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-slate-900">Naweza ku-save CV yangu?</h3>
                            <p class="mt-2 text-sm leading-7 text-slate-600">
                                Ndiyo. Ukiwa logged in unaweza kuihifadhi kwenye account yako na kuirudia baadaye.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-slate-900">Naweza kupakua PDF au Word?</h3>
                            <p class="mt-2 text-sm leading-7 text-slate-600">
                                Ndiyo. Builder hii ina support ya PDF na Word download bila kubadilisha format ya CV yako.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                    <h2 class="text-2xl font-bold text-slate-900">Best use cases</h2>
                    <ul class="mt-6 space-y-3 text-sm leading-7 text-slate-600">
                        <li>• Teaching jobs</li>
                        <li>• Office applications</li>
                        <li>• NGO / field jobs</li>
                        <li>• Internships</li>
                        <li>• Graduate applications</li>
                        <li>• General local job applications</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('components.comments-section', [
        'pageType' => 'tool',
        'pageSlug' => 'cv-builder',
        'comments' => $comments ?? collect()
    ])

    <style>
        @media print {
            .cv-preview {
                font-family: 'Times New Roman', serif;
                font-size: 12px;
                line-height: 1.5;
                color: #000;
            }

            .section-title {
                border-bottom: 1px solid #000;
                padding-bottom: 2px;
                margin-bottom: 8px;
            }

            .cv-preview table {
                width: 100%;
            }

            .cv-preview th,
            .cv-preview td {
                vertical-align: top;
            }
        }
    </style>
</div>
@endsection