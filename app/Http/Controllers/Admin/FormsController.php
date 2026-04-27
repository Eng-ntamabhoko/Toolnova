<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Form;

class FormsController extends Controller
{
    public function index()
    {
        $forms = Form::withCount('topics')->orderBy('sort_order')->paginate(20);
        $totalForms = Form::count();
        $activeForms = Form::where('is_active', true)->count();

        return view('admin.lesson-plan.forms.index', compact('forms', 'totalForms', 'activeForms'));
    }

    public function create()
    {
        return view('admin.lesson-plan.forms.create');
    }

    public function store(StoreFormRequest $request)
    {
        $validated = $request->validated();

        Form::create($validated);

        return redirect()->route('admin.forms.index')->with('success', 'Form created successfully.');
    }

    public function edit(Form $form)
    {
        return view('admin.lesson-plan.forms.edit', compact('form'));
    }

    public function update(UpdateFormRequest $request, Form $form)
    {
        $validated = $request->validated();

        $form->update($validated);

        return redirect()->route('admin.forms.index')->with('success', 'Form updated successfully.');
    }

    public function destroy(Form $form)
    {
        $form->delete();

        return redirect()->route('admin.forms.index')->with('success', 'Form deleted successfully.');
    }
}