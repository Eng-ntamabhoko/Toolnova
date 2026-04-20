<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ToolNova Admin')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/toolnova-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/toolnova-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div class="min-h-screen lg:flex">
        <!-- Mobile overlay -->
        <div
            x-show="sidebarOpen"
            x-transition.opacity
            class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden"
            @click="sidebarOpen = false"
            style="display: none;"
        ></div>

        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-72 shrink-0 -translate-x-full flex-col border-r border-slate-200 bg-white transition-transform duration-300 lg:static lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        >
            <div class="border-b border-slate-200 px-5 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-2xl bg-slate-900 text-white shadow-sm">
                        <img
                            src="{{ asset('images/toolnova-logo.png') }}"
                            alt="ToolNova"
                            class="h-8 w-8 object-contain"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <div class="hidden h-8 w-8 items-center justify-center rounded-xl bg-slate-900 text-sm font-bold text-white">
                            TN
                        </div>
                    </div>

                    <div>
                        <p class="text-base font-bold tracking-tight text-slate-900">ToolNova Admin</p>
                        <p class="text-xs text-slate-500">Analytics & platform control</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto">
                @include('admin.partials.sidebar-nav')
            </div>
        </aside>

        <!-- Main -->
        <div class="flex min-h-screen flex-1 flex-col">
            <!-- Header -->
            <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
                <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm lg:hidden"
                            @click="sidebarOpen = true"
                            aria-label="Open navigation"
                        >
                            ☰
                        </button>

                        <div>
                            <h1 class="text-lg font-bold tracking-tight text-slate-900">@yield('title', 'ToolNova Admin')</h1>
                            <p class="text-sm text-slate-500">@yield('admin_subtitle', 'Internal reporting and platform management')</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="hidden rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-slate-600 sm:inline-flex">
                            Admin Panel
                        </span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800"
                            >
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1">
                <div class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="border-t border-slate-200 bg-white">
                <div class="mx-auto flex w-full max-w-7xl flex-col gap-2 px-4 py-4 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                    <p>ToolNova Admin Dashboard</p>
                    <p>Internal analytics, operational monitoring, and platform visibility.</p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>