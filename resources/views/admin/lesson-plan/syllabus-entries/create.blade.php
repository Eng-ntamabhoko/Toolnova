@extends('layouts.admin')

@section('title', 'Create Syllabus Entry')
@section('admin_subtitle', 'Add a new syllabus entry')

@section('content')
<div class="max-w-4xl">
    <div class="rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 px-6 py-5">
            <h1 class="text-lg font-bold text-slate-900">Create Syllabus Entry</h1>
            <p class="mt-1 text-sm text-slate-500">Add a new syllabus entry with learning competencies and resources.</p>
        </div>

        <form method="POST" action="{{ route('admin.syllabus-entries.store') }}" class="p-6 space-y-6">
            @csrf

            <!-- Relationship fields -->
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="form_id" class="block text-sm font-medium text-slate-700">Form *</label>
                    <select name="form_id" id="form_id" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                        <option value="">Select a form...</option>
                        @foreach($forms as $form)
                            <option value="{{ $form->id }}" {{ old('form_id') == $form->id ? 'selected' : '' }}>{{ $form->name }}</option>
                        @endforeach
                    </select>
                    @error('form_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subject_id" class="block text-sm font-medium text-slate-700">Subject *</label>
                    <select name="subject_id" id="subject_id" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                        <option value="">Select a subject...</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="topic_id" class="block text-sm font-medium text-slate-700">Topic *</label>
                    <select name="topic_id" id="topic_id" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                        <option value="">Select a topic...</option>
                        @foreach($topics as $topic)
                            <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>{{ $topic->title }}</option>
                        @endforeach
                    </select>
                    @error('topic_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subtopic_id" class="block text-sm font-medium text-slate-700">Subtopic (Optional)</label>
                    <select name="subtopic_id" id="subtopic_id" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                        <option value="">Select a subtopic...</option>
                        @foreach($subtopics as $subtopic)
                            <option value="{{ $subtopic->id }}" {{ old('subtopic_id') == $subtopic->id ? 'selected' : '' }}>{{ $subtopic->title }}</option>
                        @endforeach
                    </select>
                    @error('subtopic_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Main competence and learning objectives -->
            <div>
                <label for="main_competence" class="block text-sm font-medium text-slate-700">Main Competence *</label>
                <input type="text" name="main_competence" id="main_competence" value="{{ old('main_competence') }}" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                @error('main_competence')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="learning_objectives" class="block text-sm font-medium text-slate-700">Learning Objectives *</label>
                <input type="text" name="learning_objectives" id="learning_objectives" value="{{ old('learning_objectives') }}" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm">
                @error('learning_objectives')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Array fields: suggested methods -->
            <div>
                <label for="suggested_methods" class="block text-sm font-medium text-slate-700">Suggested Methods *</label>
                <p class="mt-1 text-xs text-slate-500">Enter one method per line</p>
                <textarea name="suggested_methods" id="suggested_methods" rows="4" required class="mt-2 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm font-mono">{{ old('suggested_methods') }}</textarea>
                @error('suggested_methods')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Array fields: assessment criteria -->
            <div>
                <label for="assessment_criteria" class="block text-sm font-medium text-slate-700">Assessment Criteria *</label>
                <p class="mt-1 text-xs text-slate-500">Enter one criterion per line</p>
                <textarea name="assessment_criteria" id="assessment_criteria" rows="4" required class="mt-2 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm font-mono">{{ old('assessment_criteria') }}</textarea>
                @error('assessment_criteria')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Array fields: resources -->
            <div>
                <label for="resources" class="block text-sm font-medium text-slate-700">Resources *</label>
                <p class="mt-1 text-xs text-slate-500">Enter one resource per line</p>
                <textarea name="resources" id="resources" rows="4" required class="mt-2 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm font-mono">{{ old('resources') }}</textarea>
                @error('resources')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Array fields: references -->
            <div>
                <label for="references" class="block text-sm font-medium text-slate-700">References *</label>
                <p class="mt-1 text-xs text-slate-500">Enter one reference per line</p>
                <textarea name="references" id="references" rows="4" required class="mt-2 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-slate-500 focus:ring-slate-500 sm:text-sm font-mono">{{ old('references') }}</textarea>
                @error('references')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('admin.syllabus-entries.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">Cancel</a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800">Create Entry</button>
            </div>
        </form>
    </div>
</div>
@endsection
