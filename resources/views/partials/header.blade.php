<header x-data="header" class="sticky top-0 z-40 border-b border-indigo-100/70 bg-white/85 shadow-sm shadow-slate-900/[0.04] backdrop-blur-md backdrop-saturate-150">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ url('/') }}" class="group flex items-center gap-3 rounded-xl outline-offset-4 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-500">
            <img
                src="{{ asset('images/toolnova-logo.png') }}"
                alt="ToolNova Logo"
                class="h-11 w-11 rounded-2xl object-cover shadow-md shadow-indigo-900/10 ring-1 ring-slate-200/80 transition group-hover:ring-indigo-200/80"
            >
            <div>
                <span class="block text-lg font-extrabold tracking-tight text-slate-900 transition group-hover:text-indigo-950">ToolNova</span>
                <span class="block text-xs font-medium text-slate-500">Online tools platform</span>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden items-center gap-1 md:flex lg:gap-2">
            <a href="{{ url('/') }}" class="rounded-lg px-2.5 py-2 text-sm font-medium transition lg:px-3 flex items-center gap-2 {{ request()->is('/') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4V8" />
                </svg>
                Home
            </a>
            <!-- Tools Dropdown -->
            <div class="relative" @mouseenter="toolsOpen = true" @mouseleave="toolsOpen = false">
                <button class="rounded-lg px-2.5 py-2 text-sm font-medium transition lg:px-3 {{ request()->is('tools*') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-700' }} flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    Tools
                    <svg class="h-4 w-4 transition-transform" :class="toolsOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="toolsOpen" x-transition class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 z-50" @mouseenter="toolsOpen = true" @mouseleave="toolsOpen = false">
                    <div class="py-1 max-h-96 overflow-y-auto">
                        <a href="{{ url('/tools') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 font-medium {{ request()->is('tools') && !request()->is('tools/*') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" /></svg>
                            All Tools
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="{{ url('/tools/age-calculator') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Age Calculator
                        </a>
                        <a href="{{ url('/tools/word-counter') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Word Counter
                        </a>
                        <a href="{{ url('/tools/password-generator') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Password Generator
                        </a>
                        <a href="{{ url('/tools/json-formatter') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                            JSON Formatter
                        </a>
                        <a href="{{ url('/tools/qr-code-generator') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            QR Code Generator
                        </a>
                        <a href="{{ url('/tools/image-compressor') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            Image Compressor
                        </a>
                        <a href="{{ url('/tools/image-resizer') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" /></svg>
                            Image Resizer
                        </a>
                        <a href="{{ url('/tools/percentage-calculator') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3v-6m3 6H9m-3 3h6m-6-9V7a2 2 0 012-2h6a2 2 0 012 2v6m-6-9h6m-6 6h6" /></svg>
                            Percentage Calculator
                        </a>
                        <a href="{{ url('/tools/discount-calculator') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Discount Calculator
                        </a>
                        <a href="{{ url('/tools/loan-calculator') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Loan Calculator
                        </a>
                        <a href="{{ url('/tools/base64-encoder-decoder') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                            Base64 Encoder/Decoder
                        </a>
                        <a href="{{ url('/tools/text-case-converter') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            Text Case Converter
                        </a>
                        <a href="{{ url('/tools/cv-builder') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            CV Builder
                        </a>
                        <a href="{{ url('/tools/lesson-plan-generator') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8a9 9 0 100 18 9 9 0 000-18z" /></svg>
                            Lesson Plan Generator
                        </a>
                        <a href="{{ url('/tools/random-name-generator') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Random Name Generator
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ url('/tools/resume-builder') }}" class="rounded-lg px-2.5 py-2 text-sm font-medium transition lg:px-3 flex items-center gap-2 {{ request()->is('tools/resume-builder') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Resume Builder
            </a>
            <a href="{{ url('/tools/invoice-generator') }}" class="rounded-lg px-2.5 py-2 text-sm font-medium transition lg:px-3 flex items-center gap-2 {{ request()->is('tools/invoice-generator') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-700' }}">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Invoice Generator
            </a>
            <!-- Support and Information Dropdown -->
            <div class="relative" @mouseenter="supportOpen = true" @mouseleave="supportOpen = false">
                <button class="rounded-lg px-2.5 py-2 text-sm font-medium transition lg:px-3 {{ request()->is('about') || request()->is('privacy-policy') || request()->is('contact') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-600 hover:bg-indigo-50 hover:text-indigo-700' }} flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Support
                    <svg class="h-4 w-4 transition-transform" :class="supportOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="supportOpen" x-transition class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 z-50" @mouseenter="supportOpen = true" @mouseleave="supportOpen = false">
                    <div class="py-1">
                        <a href="{{ route('about') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 font-medium {{ request()->is('about') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            About
                        </a>
                        <a href="{{ route('privacy') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 {{ request()->is('privacy-policy') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Privacy Policy
                        </a>
                        <a href="{{ route('contact') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 {{ request()->is('contact') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            Contact
                        </a>
                        <a href="{{ route('terms') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 {{ request()->is('terms') ? 'bg-indigo-50 text-indigo-700' : '' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            Terms of Service
                        </a>
                    </div>
                </div>
            </div>

            @auth
                <!-- User Account Dropdown -->
                <div class="relative" @mouseenter="userOpen = true" @mouseleave="userOpen = false">
                    <button class="rounded-lg px-2.5 py-2 text-sm font-medium transition lg:px-3 text-slate-600 hover:bg-indigo-50 hover:text-indigo-700 flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="hidden lg:inline">{{ auth()->user()->name }}</span>
                    </button>
                    <div x-show="userOpen" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 z-50" @mouseenter="userOpen = true" @mouseleave="userOpen = false">
                        <div class="py-2 px-3 border-b border-indigo-100">
                            <p class="text-xs font-semibold text-slate-600">SIGNED IN AS</p>
                            <p class="text-sm font-bold text-slate-900 mt-1 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50 font-medium">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4V8" /></svg>
                                Dashboard
                            </a>
                            <a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                Profile
                            </a>
                            <a href="{{ route('dashboard.settings') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-indigo-50">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Settings
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 font-medium">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="rounded-lg px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-700 transition lg:px-3 flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Login
                </a>
                <a href="{{ route('register') }}" class="rounded-lg px-2.5 py-2 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-700 transition lg:px-3 flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    Register
                </a>
            @endauth
        </nav>

        <!-- Mobile Menu Button -->
        <div class="flex items-center gap-4 md:hidden">
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="inline-flex items-center justify-center rounded-xl p-2 text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                aria-expanded="false"
            >
                <span class="sr-only">Open main menu</span>
                <svg
                    x-show="!mobileMenuOpen"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg
                    x-show="mobileMenuOpen"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Desktop CTA Button -->
        @auth
            <a href="{{ route('dashboard') }}" class="hidden items-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 transition hover:from-indigo-500 hover:to-violet-500 hover:shadow-lg hover:shadow-indigo-500/35 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 md:inline-flex">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4V8" />
                </svg>
                Go to Dashboard
            </a>
        @else
            <a href="{{ url('/tools') }}" class="hidden items-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/30 transition hover:from-indigo-500 hover:to-violet-500 hover:shadow-lg hover:shadow-indigo-500/35 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 md:inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10.5 6a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 6Z"/>
                    <path d="M10.5 12a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 12Z"/>
                    <path d="M10.5 18a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 18Z"/>
                    <path fill-rule="evenodd" d="M3.75 5.25A2.25 2.25 0 0 1 6 3h1.5a2.25 2.25 0 0 1 2.25 2.25v1.5A2.25 2.25 0 0 1 7.5 9H6a2.25 2.25 0 0 1-2.25-2.25v-1.5Zm2.25-.75a.75.75 0 0 0-.75.75v1.5c0 .414.336.75.75.75h1.5a.75.75 0 0 0 .75-.75v-1.5a.75.75 0 0 0-.75-.75H6Z" clip-rule="evenodd"/>
                </svg>
                Explore Tools
            </a>
        @endauth
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition class="border-t border-indigo-100/60 bg-gradient-to-b from-white to-indigo-50/40 md:hidden">
        <div class="space-y-0.5 px-2 pb-3 pt-2 sm:px-3">
            <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('/') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4V8" /></svg>
                Home
            </a>
            <!-- Tools Mobile -->
            <button @click="toolsOpen = !toolsOpen" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('tools*') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                    Tools
                </div>
                <svg class="h-5 w-5 transition-transform" :class="toolsOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="toolsOpen" x-transition class="ml-4 space-y-0.5 max-h-64 overflow-y-auto">
                <a href="{{ url('/tools') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('tools') && !request()->is('tools/*') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" /></svg>
                    All Tools
                </a>
                <div class="border-t border-indigo-100/60 my-1"></div>
                <a href="{{ url('/tools/age-calculator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Age Calculator
                </a>
                <a href="{{ url('/tools/word-counter') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Word Counter
                </a>
                <a href="{{ url('/tools/password-generator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    Password Generator
                </a>
                <a href="{{ url('/tools/json-formatter') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                    JSON Formatter
                </a>
                <a href="{{ url('/tools/qr-code-generator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    QR Code Generator
                </a>
                <a href="{{ url('/tools/image-compressor') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Image Compressor
                </a>
                <a href="{{ url('/tools/image-resizer') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" /></svg>
                    Image Resizer
                </a>
                <a href="{{ url('/tools/percentage-calculator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3v-6m3 6H9m-3 3h6m-6-9V7a2 2 0 012-2h6a2 2 0 012 2v6m-6-9h6m-6 6h6" /></svg>
                    Percentage Calculator
                </a>
                <a href="{{ url('/tools/discount-calculator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Discount Calculator
                </a>
                <a href="{{ url('/tools/loan-calculator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Loan Calculator
                </a>
                <a href="{{ url('/tools/base64-encoder-decoder') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                    Base64 Encoder/Decoder
                </a>
                <a href="{{ url('/tools/text-case-converter') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                    Text Case Converter
                </a>
                <a href="{{ url('/tools/cv-builder') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    CV Builder
                </a>
                <a href="{{ url('/tools/lesson-plan-generator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8a9 9 0 100 18 9 9 0 000-18z" /></svg>
                    Lesson Plan Generator
                </a>
                <a href="{{ url('/tools/random-name-generator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition text-slate-700 hover:bg-white/80 hover:text-indigo-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Random Name Generator
                </a>
            </div>
            <a href="{{ url('/tools/resume-builder') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('tools/resume-builder') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Resume Builder
            </a>
            <a href="{{ url('/tools/invoice-generator') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('tools/invoice-generator') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Invoice Generator
            </a>
            <!-- Support and Information Mobile -->
            <button @click="supportOpen = !supportOpen" class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('about') || request()->is('privacy-policy') || request()->is('contact') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Support
                </div>
                <svg class="h-5 w-5 transition-transform" :class="supportOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="supportOpen" x-transition class="ml-4 space-y-0.5">
                <a href="{{ route('about') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('about') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    About
                </a>
                <a href="{{ route('privacy') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('privacy-policy') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    Privacy Policy
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('contact') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    Contact
                </a>
                <a href="{{ route('terms') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-base font-medium transition {{ request()->is('terms') ? 'bg-indigo-100 text-indigo-700' : 'text-slate-700 hover:bg-white/80 hover:text-indigo-700' }}">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                    Terms of Service
                </a>
            </div>
        </div>
        <div class="border-t border-indigo-100/70 pb-4 pt-4">
            <div class="flex flex-col gap-3 px-5">
                @auth
                    <div class="mb-2 pb-3 border-b border-indigo-100/70">
                        <p class="text-xs font-medium text-slate-600 mb-2">Welcome!</p>
                        <p class="text-sm font-semibold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-100 text-indigo-700 px-4 py-2.5 text-sm font-semibold transition hover:bg-indigo-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4V8" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('dashboard.profile') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 text-slate-900 px-4 py-2.5 text-sm font-semibold transition hover:bg-slate-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Profile
                    </a>
                    <a href="{{ route('dashboard.settings') }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 text-slate-900 px-4 py-2.5 text-sm font-semibold transition hover:bg-slate-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-red-100 text-red-700 px-4 py-2.5 text-sm font-semibold transition hover:bg-red-200">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-100 text-slate-900 px-4 py-2.5 text-sm font-semibold transition hover:bg-slate-200">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/25 transition hover:from-indigo-500 hover:to-violet-500">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        Register
                    </a>
                @endauth
                <div class="border-t border-indigo-100/70 pt-3">
                    <a href="{{ url('/tools') }}" class="inline-flex w-full justify-center items-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-violet-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/25 transition hover:from-indigo-500 hover:to-violet-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10.5 6a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 6Z"/>
                            <path d="M10.5 12a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 12Z"/>
                            <path d="M10.5 18a.75.75 0 0 1 .75-.75h8.25a.75.75 0 0 1 0 1.5H11.25A.75.75 0 0 1 10.5 18Z"/>
                            <path fill-rule="evenodd" d="M3.75 5.25A2.25 2.25 0 0 1 6 3h1.5a2.25 2.25 0 0 1 2.25 2.25v1.5A2.25 2.25 0 0 1 7.5 9H6a2.25 2.25 0 0 1-2.25-2.25v-1.5Zm2.25-.75a.75.75 0 0 0-.75.75v1.5c0 .414.336.75.75.75h1.5a.75.75 0 0 0 .75-.75v-1.5a.75.75 0 0 0-.75-.75H6Z" clip-rule="evenodd"/>
                        </svg>
                        Explore Tools
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('header', () => ({
        mobileMenuOpen: false,
        supportOpen: false,
        toolsOpen: false,
        userOpen: false
    }))
})
</script>