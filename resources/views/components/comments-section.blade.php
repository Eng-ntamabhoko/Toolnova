@if(session('success'))
    <div class="mb-4 rounded-xl border border-green-200 bg-green-100 px-4 py-3 text-sm text-green-800">
        <p class="font-medium">🎉 Comment Submitted!</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

<section class="mt-16 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
    <div>
<h2 class="text-2xl font-bold text-slate-900">Comments & Feedback ({{ $comments->count() }})</h2>
        <p class="mt-2 text-slate-600">Share your experience or feedback about this tool.</p>
    </div>

    @if($comments->count() > 0)
        <div class="mt-8 space-y-6">
            @foreach($comments as $comment)
                <div class="rounded-2xl border border-slate-200 p-5">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-700">
                                    {{ substr($comment->name ?? 'Anonymous', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $comment->name ?? 'Anonymous' }}</p>
                                    <p class="text-sm text-slate-500">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="mt-3 text-slate-700 leading-relaxed">
                                {!! nl2br(e($comment->content)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="mt-8 rounded-2xl border-2 border-dashed border-slate-200 p-8 text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                </svg>
            </div>
            <h3 class="mt-4 text-lg font-semibold text-slate-900">No comments yet</h3>
            <p class="mt-2 text-slate-500">Be the first to share your thoughts about this tool.</p>
        </div>
    @endif

    <!-- Comment Form -->
    <div class="mt-8 rounded-2xl border border-slate-200 p-6">
        <h3 class="text-lg font-bold text-slate-900">Leave a Comment</h3>
        <p class="mt-1 text-sm text-slate-500">Your comment will be reviewed before being published.</p>

        <form method="POST" action="{{ route('comments.store') }}" class="mt-6 space-y-4">
            @csrf

            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" value="">
            <input type="hidden" name="form_started_at" value="{{ now()->timestamp }}">

            <input type="hidden" name="page_type" value="{{ $pageType }}">
            <input type="hidden" name="page_slug" value="{{ $pageSlug }}">

            @error('rate_limit')
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">{{ $message }}</div>
            @enderror

            @if(!auth()->check())
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            placeholder="Your name"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700">Email <span class="text-slate-500">(optional)</span></label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                            placeholder="your@email.com"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endif

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700">Comment</label>
                <textarea
                    id="content"
                    name="content"
                    rows="4"
                    class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-800 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    placeholder="Share your thoughts..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <p class="text-sm text-slate-500">
                    Comments are moderated to maintain quality.
                </p>

                <button
                    type="submit"
                    class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-600"
                >
                    Submit Comment
                </button>
            </div>
        </form>
    </div>
</section>