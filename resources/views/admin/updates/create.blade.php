@extends('layouts.admin')

@section('title', 'Create Site Update')
@section('admin_subtitle', 'Add a new update to display on the homepage')

@section('content')
<div class="max-w-4xl">
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h1 class="text-lg font-bold text-slate-900">Create Site Update</h1>
            <p class="mt-1 text-sm text-slate-500">Add a new update that will appear in the Latest Updates section.</p>
        </div>

        <form method="POST" action="{{ route('admin.updates.store') }}" class="p-6 space-y-6">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                    <p class="mt-1 text-xs text-slate-500">Leave empty to auto-generate from title</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-slate-700">Excerpt *</label>
                <textarea name="excerpt" id="excerpt" rows="3" required class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">{{ old('excerpt') }}</textarea>
                <p class="mt-1 text-xs text-slate-500">Brief summary shown on homepage (max 1000 characters)</p>
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-slate-700">Content</label>
                <textarea name="content" id="content" rows="6" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">{{ old('content') }}</textarea>
                <p class="mt-1 text-xs text-slate-500">Optional full content for detailed updates</p>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div>
                    <label for="update_type" class="block text-sm font-medium text-slate-700">Update Type</label>
                    <select name="update_type" id="update_type" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                        <option value="">Select type...</option>
                        <option value="New Tool" {{ old('update_type') == 'New Tool' ? 'selected' : '' }}>New Tool</option>
                        <option value="Improvement" {{ old('update_type') == 'Improvement' ? 'selected' : '' }}>Improvement</option>
                        <option value="Feature Update" {{ old('update_type') == 'Feature Update' ? 'selected' : '' }}>Feature Update</option>
                        <option value="Announcement" {{ old('update_type') == 'Announcement' ? 'selected' : '' }}>Announcement</option>
                    </select>
                    @error('update_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                    <p class="mt-1 text-xs text-slate-500">Lower numbers appear first</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="published_at" class="block text-sm font-medium text-slate-700">Published At</label>
                    <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                    <p class="mt-1 text-xs text-slate-500">Leave empty for immediate publish</p>
                    @error('published_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-slate-700">Link</label>
                <input type="url" name="link" id="link" value="{{ old('link') }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                <p class="mt-1 text-xs text-slate-500">Optional URL for "Learn more" button</p>
                @error('link')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-600 focus:ring-slate-500">
                    <label for="is_published" class="ml-2 block text-sm text-slate-700">Published</label>
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_featured_on_home" value="0">
                    <input type="checkbox" name="is_featured_on_home" id="is_featured_on_home" value="1" {{ old('is_featured_on_home', true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-600 focus:ring-slate-500">
                    <label for="is_featured_on_home" class="ml-2 block text-sm text-slate-700">Featured on Homepage</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.updates.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">
                    Create Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection