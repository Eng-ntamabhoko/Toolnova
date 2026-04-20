<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Topic;
use App\Models\Subject;
use App\Models\Form;

class TopicsController extends Controller
{
    public function index()
    {
        $topics = Topic::with('subject', 'form')->orderBy('title')->paginate(20);
        $totalTopics = Topic::count();
        $activeTopics = Topic::where('is_active', true)->count();

        return view('admin.lesson-plan.topics.index', compact('topics', 'totalTopics', 'activeTopics'));
    }

    public function create()
    {
        $subjects = Subject::where('is_active', true)->orderBy('name')->get();
        $forms = Form::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.lesson-plan.topics.create', compact('subjects', 'forms'));
    }

    public function store(StoreTopicRequest $request)
    {
        $validated = $request->validated();
        
        Topic::create($validated);

        return redirect()->route('admin.topics.index')->with('success', 'Topic created successfully.');
    }

    public function edit(Topic $topic)
    {
        $subjects = Subject::where('is_active', true)->orderBy('name')->get();
        $forms = Form::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.lesson-plan.topics.edit', compact('topic', 'subjects', 'forms'));
    }

    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $validated = $request->validated();
        
        $topic->update($validated);

        return redirect()->route('admin.topics.index')->with('success', 'Topic updated successfully.');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully.');
    }
}
