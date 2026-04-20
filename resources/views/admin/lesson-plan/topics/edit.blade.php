@extends('layouts.admin')

@section('title', 'Edit Topic')
@section('admin_subtitle', $topic->title)

@section('content')
<div class="max-w-4xl">
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h1 class="text-lg font-bold text-slate-900">Edit Topic</h1>
            <p class="mt-1 text-sm text-slate-500">Update topic details.</p>
        </div>

        <form method="POST" action="{{ route('admin.topics.update', $topic) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="subject_id" class="block text-sm font-medium text-slate-700">Subject *</label>
                    <select name="subject_id" id="subject_id" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                        <option value="">Select a subject...</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $topic->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="form_id" class="block text-sm font-medium text-slate-700">Form *</label>
                    <select name="form_id" id="form_id" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                        <option value="">Select a form...</option>
                        @foreach($forms as $form)
                            <option value="{{ $form->id }}" {{ old('form_id', $topic->form_id) == $form->id ? 'selected' : '' }}>{{ $form->name }}</option>
                        @endforeach
                    </select>
                    @error('form_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $topic->title) }}" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="slug" class="block text-sm font-medium text-slate-700">Slug *</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $topic->slug) }}" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $topic->sort_order ?? 0) }}" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                </div>
            </div>

            <div class="flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $topic->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-600 focus:ring-slate-500">
                <label for="is_active" class="ml-2 block text-sm text-slate-700">Active</label>
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.topics.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">Cancel</a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">Update Topic</button>
            </div>
        </form>
    </div>
</div>
@endsection
