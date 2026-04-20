<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Support\Str;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name')->paginate(20);
        $totalSubjects = Subject::count();
        $activeSubjects = Subject::where('is_active', true)->count();

        return view('admin.lesson-plan.subjects.index', compact('subjects', 'totalSubjects', 'activeSubjects'));
    }

    public function create()
    {
        return view('admin.lesson-plan.subjects.create');
    }

    public function store(StoreSubjectRequest $request)
    {
        $validated = $request->validated();
        
        Subject::create($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.lesson-plan.subjects.edit', compact('subject'));
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $validated = $request->validated();
        
        $subject->update($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
