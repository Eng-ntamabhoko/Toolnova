@extends('layouts.app')

@section('title', 'All Tools - ToolNova')
@section('meta_description', 'Explore free online tools for calculations, text editing, images, coding, business and productivity on ToolNova.')

@section('content')
<div class="bg-slate-50">

    <section class="relative overflow-hidden bg-slate-950">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(59,130,246,0.22),transparent_35%),radial-gradient(circle_at_bottom_right,rgba(14,165,233,0.18),transparent_30%)]"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-medium text-blue-200 sm:text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M3.75 5.25A2.25 2.25 0 0 1 6 3h12a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 18 21H6a2.25 2.25 0 0 1-2.25-2.25V5.25Z"/>
                    </svg>
                    Tool Directory
                </span>

                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    Explore All Tools
                </h1>

                <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-lg sm:leading-8">
                    Browse fast, useful tools for calculations, text work, coding, images, documents and productivity.
                </p>
            </div>
        </div>
    </section>

    <section class="py-8 sm:py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mb-8 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                            <h2 class="text-xl font-bold text-slate-900">{{ count($tools) }} Active Tools</h2>
                    </div>

                    <div class="rounded-2xl bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">
                        Updated library
                    </div>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($tools as $tool)
                    <a
                        href="{{ url('/tools/' . $tool['slug']) }}"
                        class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-br from-white to-slate-50/50 p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-blue-300 hover:shadow-xl hover:shadow-blue-500/10"
                    >
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/20 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                        <div class="relative">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <span class="inline-flex rounded-full bg-gradient-to-r from-blue-100 to-blue-200 px-3 py-1 text-xs font-semibold text-blue-700 shadow-sm">
                                        {{ $tool['category'] }}
                                    </span>

                                    <h3 class="mt-4 text-xl font-bold text-slate-900 transition-colors group-hover:text-blue-700">
                                        {{ $tool['name'] }}
                                    </h3>
                                </div>

                                <span class="rounded-2xl bg-slate-100 p-2 text-slate-500 transition-all duration-300 group-hover:bg-blue-100 group-hover:text-blue-700 group-hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M13.28 4.97a.75.75 0 0 1 1.06 0l5.69 5.69a.75.75 0 0 1 0 1.06l-5.69 5.69a.75.75 0 0 1-1.06-1.06l4.41-4.41H4.5a.75.75 0 0 1 0-1.5h13.19l-4.41-4.41a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </div>

                            <p class="mt-4 text-sm leading-6 text-slate-600 transition-colors group-hover:text-slate-700">
                                {{ $tool['description'] }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
</div>
@endsection