<footer class="relative border-t border-indigo-500/20 bg-gradient-to-b from-slate-900 via-slate-900 to-indigo-950 text-slate-300">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,rgba(99,102,241,0.18),transparent)]" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-4">
            <div class="md:col-span-2">
                <a href="{{ url('/') }}" class="group flex items-center gap-3 rounded-xl outline-offset-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-400">
                    <img
                        src="{{ asset('images/toolnova-logo.png') }}"
                        alt="ToolNova Logo"
                        class="h-11 w-11 rounded-2xl object-cover shadow-lg shadow-black/30 ring-1 ring-white/10 transition group-hover:ring-indigo-400/40"
                    >

                    <div>
                        <h3 class="text-lg font-extrabold text-white transition group-hover:text-indigo-100">ToolNova</h3>
                        <p class="text-sm font-medium text-indigo-200/80">Free online tools</p>
                    </div>
                </a>

                <p class="mt-4 max-w-md text-sm leading-6 text-slate-400">
                    Use clean, modern tools for calculations, text editing, coding, images, documents and daily work.
                </p>

                <div class="mt-5 flex flex-wrap gap-3">
                    <span class="inline-flex items-center gap-2 rounded-full border border-sky-500/20 bg-sky-500/10 px-3 py-2 text-xs font-semibold text-sky-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.25 4.5a.75.75 0 0 1 1.5 0v6.19l4.72 2.72a.75.75 0 0 1-.75 1.3l-5.1-2.94a.75.75 0 0 1-.37-.65V4.5Z"/>
                            <path fill-rule="evenodd" d="M12 2.25a9.75 9.75 0 1 0 9.75 9.75A9.761 9.761 0 0 0 12 2.25Z" clip-rule="evenodd"/>
                        </svg>
                        Fast Tools
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-2 text-xs font-semibold text-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 1.5a8.25 8.25 0 0 0-8.25 8.25c0 2.187.85 4.176 2.236 5.655-.24.852-.65 1.83-1.392 2.854a.75.75 0 0 0 .952 1.124c1.16-.57 2.323-.96 3.21-1.202A8.214 8.214 0 0 0 12 18a8.25 8.25 0 1 0 0-16.5Z" clip-rule="evenodd"/>
                        </svg>
                        Easy to Use
                    </span>

                    <span class="inline-flex items-center gap-2 rounded-full border border-violet-500/20 bg-violet-500/10 px-3 py-2 text-xs font-semibold text-violet-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-violet-400" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 1.5a.75.75 0 0 1 .75.75v1.153a8.25 8.25 0 0 1 6.77 6.77h1.153a.75.75 0 0 1 0 1.5H19.52a8.25 8.25 0 0 1-6.77 6.77v1.153a.75.75 0 0 1-1.5 0V20.52a8.25 8.25 0 0 1-6.77-6.77H3.327a.75.75 0 0 1 0-1.5H4.48a8.25 8.25 0 0 1 6.77-6.77V2.25A.75.75 0 0 1 12 1.5Z" clip-rule="evenodd"/>
                        </svg>
                        Modern Design
                    </span>
                </div>
            </div>

            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-indigo-300/90">Platform</h4>
                <ul class="mt-4 space-y-3 text-sm text-slate-400">
                    <li><a href="{{ url('/') }}" class="rounded-md transition hover:text-white hover:underline decoration-indigo-400/80 underline-offset-4">Home</a></li>
                    <li><a href="{{ url('/tools') }}" class="rounded-md transition hover:text-white hover:underline decoration-indigo-400/80 underline-offset-4">All Tools</a></li>
                    <li><a href="{{ route('about') }}" class="rounded-md transition hover:text-white hover:underline decoration-indigo-400/80 underline-offset-4">About</a></li>
                    <li><a href="{{ url('/tools/resume-builder') }}" class="rounded-md transition hover:text-white hover:underline decoration-indigo-400/80 underline-offset-4">Resume Builder</a></li>
                    <li><a href="{{ url('/tools/invoice-generator') }}" class="rounded-md transition hover:text-white hover:underline decoration-indigo-400/80 underline-offset-4">Invoice Generator</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-indigo-300/90">Support</h4>
                <ul class="mt-4 space-y-3 text-sm text-slate-400">
                    <li><a href="{{ route('contact') }}" class="rounded-md transition hover:text-white hover:underline decoration-indigo-400/80 underline-offset-4">Contact Us</a></li>
                    <li><a href="{{ route('privacy') }}" class="rounded-md transition hover:text-white hover:underline decoration-indigo-400/80 underline-offset-4">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="rounded-md transition hover:text-white hover:underline decoration-indigo-400/80 underline-offset-4">Terms of Service</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 flex flex-col items-center justify-between gap-4 border-t border-white/10 pt-6 text-sm text-slate-500 sm:flex-row sm:text-left">
            <p class="text-center sm:text-left">© {{ date('Y') }} ToolNova. All rights reserved.</p>
            <a
                href="#top"
                class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-indigo-200 transition hover:bg-white/5 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-400/60"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
                Back to top
            </a>
        </div>
    </div>
</footer>