@extends('layouts.app')

@section('content')

<div class="bg-slate-50">

    <!-- Tool Header -->
    <section class="bg-slate-950 text-white">
        <div class="max-w-6xl mx-auto px-4 py-16">

            <h1 class="text-4xl font-bold">
                @yield('tool_title')
            </h1>

            <p class="mt-4 text-slate-300 max-w-2xl">
                @yield('tool_description')
            </p>

        </div>
    </section>

    <!-- Tool Interface -->
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-4">

            <div class="grid gap-8 lg:grid-cols-12">

                <!-- Tool -->
                <div class="lg:col-span-8">

                    <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">

                        @yield('tool_content')

                    </div>

                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-4 space-y-6">

                    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">Related Tools</h3>

                        <ul class="mt-4 space-y-2 text-sm">

                            <li>
                                <a href="/tools/word-counter" class="text-blue-600 hover:underline">
                                    Word Counter
                                </a>
                            </li>

                            <li>
                                <a href="/tools/password-generator" class="text-blue-600 hover:underline">
                                    Password Generator
                                </a>
                            </li>

                            <li>
                                <a href="/tools/json-formatter" class="text-blue-600 hover:underline">
                                    JSON Formatter
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">About this tool</h3>

                        <p class="mt-3 text-sm text-slate-600">
                            @yield('tool_about')
                        </p>
                    </div>

                </aside>

            </div>

        </div>
    </section>

    <!-- Guide Section -->
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">

                <h2 class="text-2xl font-bold text-slate-900">
                    How to Use
                </h2>

                <div class="mt-4 text-slate-600 leading-7">
                    @yield('tool_guide')
                </div>

            </div>

        </div>
    </section>

</div>

@endsection