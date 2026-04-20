<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSyllabusEntryRequest;
use App\Http\Requests\UpdateSyllabusEntryRequest;
use App\Models\SyllabusEntry;
use App\Models\Form;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Subtopic;

class SyllabusEntriesController extends Controller
{
    public function index()
    {
        $entries = SyllabusEntry::with('form', 'subject', 'topic', 'subtopic')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $totalEntries = SyllabusEntry::count();
        $formCount = SyllabusEntry::distinct('form_id')->count('form_id');
        $subjectCount = SyllabusEntry::distinct('subject_id')->count('subject_id');
        $topicCount = SyllabusEntry::distinct('topic_id')->count('topic_id');

        return view('admin.lesson-plan.syllabus-entries.index', compact('entries', 'totalEntries', 'formCount', 'subjectCount', 'topicCount'));
    }

    public function create()
    {
        $forms = Form::where('is_active', true)->orderBy('sort_order')->get();
        $subjects = Subject::where('is_active', true)->orderBy('name')->get();
        $topics = Topic::where('is_active', true)->with('subject')->orderBy('title')->get();
        $subtopics = Subtopic::where('is_active', true)->with('topic')->orderBy('title')->get();

        return view('admin.lesson-plan.syllabus-entries.create', compact('forms', 'subjects', 'topics', 'subtopics'));
    }

    public function store(StoreSyllabusEntryRequest $request)
    {
        $validated = $request->validated();
        
        // Convert newline-separated strings to arrays
        $validated['suggested_methods'] = $this->textToArray($validated['suggested_methods'] ?? null);
        $validated['assessment_criteria'] = $this->textToArray($validated['assessment_criteria'] ?? null);
        $validated['resources'] = $this->textToArray($validated['resources'] ?? null);
        $validated['references'] = $this->textToArray($validated['references'] ?? null);

        SyllabusEntry::create($validated);

        return redirect()->route('admin.syllabus-entries.index')->with('success', 'Syllabus entry created successfully.');
    }

    public function edit(SyllabusEntry $entry)
    {
        $forms = Form::where('is_active', true)->orderBy('sort_order')->get();
        $subjects = Subject::where('is_active', true)->orderBy('name')->get();
        $topics = Topic::where('is_active', true)->with('subject')->orderBy('title')->get();
        $subtopics = Subtopic::where('is_active', true)->with('topic')->orderBy('title')->get();

        $entry->suggested_methods = $this->arrayToText($entry->suggested_methods);
        $entry->assessment_criteria = $this->arrayToText($entry->assessment_criteria);
        $entry->resources = $this->arrayToText($entry->resources);
        $entry->references = $this->arrayToText($entry->references);

        return view('admin.lesson-plan.syllabus-entries.edit', compact('entry', 'forms', 'subjects', 'topics', 'subtopics'));
    }

    public function update(UpdateSyllabusEntryRequest $request, SyllabusEntry $entry)
    {
        $validated = $request->validated();
        
        // Convert newline-separated strings to arrays
        $validated['suggested_methods'] = $this->textToArray($validated['suggested_methods'] ?? null);
        $validated['assessment_criteria'] = $this->textToArray($validated['assessment_criteria'] ?? null);
        $validated['resources'] = $this->textToArray($validated['resources'] ?? null);
        $validated['references'] = $this->textToArray($validated['references'] ?? null);

        $entry->update($validated);

        return redirect()->route('admin.syllabus-entries.index')->with('success', 'Syllabus entry updated successfully.');
    }

    public function destroy(SyllabusEntry $entry)
    {
        $entry->delete();

        return redirect()->route('admin.syllabus-entries.index')->with('success', 'Syllabus entry deleted successfully.');
    }

    private function textToArray($text)
    {
        if (empty($text)) {
            return null;
        }

        $lines = array_filter(array_map('trim', explode("\n", $text)));
        return !empty($lines) ? array_values($lines) : null;
    }

    private function arrayToText($array)
    {
        if (empty($array) || !is_array($array)) {
            return '';
        }

        return implode("\n", $array);
    }
}
