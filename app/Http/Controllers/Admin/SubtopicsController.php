<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubtopicRequest;
use App\Http\Requests\UpdateSubtopicRequest;
use App\Models\Subtopic;
use App\Models\Topic;

class SubtopicsController extends Controller
{
    public function index()
    {
        $subtopics = Subtopic::with('topic.subject')->orderBy('title')->paginate(20);
        $totalSubtopics = Subtopic::count();
        $activeSubtopics = Subtopic::where('is_active', true)->count();
        $topicCount = Topic::count();

        return view('admin.lesson-plan.subtopics.index', compact('subtopics', 'totalSubtopics', 'activeSubtopics', 'topicCount'));
    }

    public function create()
    {
        $topics = Topic::where('is_active', true)->with('subject')->orderBy('title')->get();

        return view('admin.lesson-plan.subtopics.create', compact('topics'));
    }

    public function store(StoreSubtopicRequest $request)
    {
        $validated = $request->validated();
        
        Subtopic::create($validated);

        return redirect()->route('admin.subtopics.index')->with('success', 'Subtopic created successfully.');
    }

    public function edit(Subtopic $subtopic)
    {
        $topics = Topic::where('is_active', true)->with('subject')->orderBy('title')->get();

        return view('admin.lesson-plan.subtopics.edit', compact('subtopic', 'topics'));
    }

    public function update(UpdateSubtopicRequest $request, Subtopic $subtopic)
    {
        $validated = $request->validated();
        
        $subtopic->update($validated);

        return redirect()->route('admin.subtopics.index')->with('success', 'Subtopic updated successfully.');
    }

    public function destroy(Subtopic $subtopic)
    {
        $subtopic->delete();

        return redirect()->route('admin.subtopics.index')->with('success', 'Subtopic deleted successfully.');
    }
}
