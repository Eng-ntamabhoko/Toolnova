@extends('layouts.admin')

@section('title', 'Edit Subtopic')
@section('admin_subtitle', $subtopic->title)

@section('content')
<div class="max-w-4xl">
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h1 class="text-lg font-bold text-slate-900">Edit Subtopic</h1>
            <p class="mt-1 text-sm text-slate-500">Update subtopic details.</p>
        </div>

        <form method="POST" action="{{ route('admin.subtopics.update', $subtopic) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="topic_id" class="block text-sm font-medium text-slate-700">Topic *</label>
                <select name="topic_id" id="topic_id" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                    <option value="">Select a topic...</option>
                    @foreach($topics as $topic)
                        <option value="{{ $topic->id }}" {{ old('topic_id', $subtopic->topic_id) == $topic->id ? 'selected' : '' }}>{{ $topic->title }}</option>
                    @endforeach
                </select>
                @error('topic_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $subtopic->title) }}" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug *</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $subtopic->slug) }}" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $subtopic->sort_order ?? 0) }}" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                </div>
            </div>

            <div class="flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $subtopic->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-600 focus:ring-slate-500">
                <label for="is_active" class="ml-2 block text-sm text-slate-700">Active</label>
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.subtopics.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">Cancel</a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">Update Subtopic</button>
            </div>
        </form>
    </div>
</div>
@endsection
