@extends('layouts.admin')

@section('title', 'Edit Form')
@section('admin_subtitle', 'Update form details')

@section('content')
<div class="max-w-4xl">
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h1 class="text-lg font-bold text-slate-900">Edit Form</h1>
            <p class="mt-1 text-sm text-slate-500">Modify form information.</p>
        </div>

        <form method="POST" action="{{ route('admin.forms.update', $form) }}" class="p-6 space-y-6">
            @csrf @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Form Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $form->name) }}" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sort_order" class="block text-sm font-medium text-slate-700">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $form->sort_order) }}" min="0" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                <p class="mt-1 text-xs text-slate-500">Order in which forms appear in dropdowns</p>
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $form->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-slate-600 focus:ring-slate-500">
                <label for="is_active" class="ml-2 block text-sm text-slate-700">Active</label>
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.forms.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">Cancel</a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">Update Form</button>
            </div>
        </form>
    </div>
</div>
@endsection