<nav class="px-4 py-5" x-data="{ analyticsOpen: false, contentOpen: false, usersOpen: false, lessonOpen: false }">
    <div class="space-y-1">
        <!-- Analytics Dropdown -->
        <div class="relative">
            <button
                @click="analyticsOpen = !analyticsOpen"
                class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->is('admin') || request()->is('admin/overview') || request()->is('admin/tool-usage') || request()->is('admin/traffic') || request()->is('admin/countries') || request()->is('admin/devices') || request()->is('admin/referrers') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}"
            >
                <span class="flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Analytics
                </span>
                <svg class="h-4 w-4 transition-transform" :class="analyticsOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="analyticsOpen" x-transition class="mt-1 space-y-1 pl-4">
                <a
                    href="{{ route('admin.overview') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin') || request()->is('admin/overview') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Overview
                </a>

                <a
                    href="{{ route('admin.tool-usage') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/tool-usage') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Tool Usage
                </a>

                <a
                    href="{{ url('/admin/traffic') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/traffic') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Traffic
                </a>

                <a
                    href="{{ url('/admin/countries') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/countries') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Countries
                </a>

                <a
                    href="{{ url('/admin/devices') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/devices') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Devices
                </a>

                <a
                    href="{{ url('/admin/referrers') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/referrers') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Referrers
                </a>
            </div>
        </div>

        <!-- Content Management Dropdown -->
        <div class="relative">
            <button
                @click="contentOpen = !contentOpen"
                class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->is('admin/tools') || request()->is('admin/updates*') || request()->is('admin/comments*') || request()->is('admin/messages*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}"
            >
                <span class="flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Content
                </span>
                <svg class="h-4 w-4 transition-transform" :class="contentOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="contentOpen" x-transition class="mt-1 space-y-1 pl-4">
                <a
                    href="{{ url('/admin/tools') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/tools') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Tools
                </a>

                <a
                    href="{{ route('admin.updates.index') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/updates*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Updates
                </a>

                <a
                    href="{{ route('admin.comments') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/comments*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Comments
                </a>

                <a
                    href="{{ route('admin.messages.index') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/messages*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Messages
                </a>
            </div>
        </div>

        <!-- Users Dropdown -->
        <div class="relative">
            <button
                @click="usersOpen = !usersOpen"
                class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->is('admin/users') || request()->is('admin/settings') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}"
            >
                <span class="flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                    Users
                </span>
                <svg class="h-4 w-4 transition-transform" :class="usersOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="usersOpen" x-transition class="mt-1 space-y-1 pl-4">
                <a
                    href="{{ url('/admin/users') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/users') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    User Management
                </a>

                <a
                    href="{{ url('/admin/settings') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/settings') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Settings
                </a>
            </div>
        </div>

        <!-- Lesson Planning Dropdown -->
        <div class="relative">
            <button
                @click="lessonOpen = !lessonOpen"
                class="flex w-full items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition {{ request()->is('admin/forms*') || request()->is('admin/subjects*') || request()->is('admin/topics*') || request()->is('admin/subtopics*') || request()->is('admin/syllabus-entries*') ? 'bg-slate-900 text-white shadow-sm' : 'text-slate-700 hover:bg-slate-100 hover:text-slate-900' }}"
            >
                <span class="flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Lesson Planning
                </span>
                <svg class="h-4 w-4 transition-transform" :class="lessonOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="lessonOpen" x-transition class="mt-1 space-y-1 pl-4">
                <a
                    href="{{ route('admin.forms.index') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/forms*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Forms
                </a>

                <a
                    href="{{ route('admin.subjects.index') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/subjects*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Subjects
                </a>

                <a
                    href="{{ route('admin.topics.index') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/topics*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Topics
                </a>

                <a
                    href="{{ route('admin.subtopics.index') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/subtopics*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Subtopics
                </a>

                <a
                    href="{{ route('admin.syllabus-entries.index') }}"
                    class="block rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->is('admin/syllabus-entries*') ? 'bg-slate-800 text-white' : 'text-slate-600 hover:bg-slate-200 hover:text-slate-900' }}"
                >
                    Syllabus Entries
                </a>
            </div>
        </div>
    </div>
</nav>