<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSyllabusEntryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'form_id' => 'required|exists:forms,id',
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required|exists:topics,id',
            'subtopic_id' => 'nullable|exists:subtopics,id',
            'main_competence' => 'required|string',
            'specific_competence' => 'required|string',
            'main_activity' => 'nullable|string',
            'specific_activity' => 'nullable|string',
            'suggested_methods' => 'nullable|string',
            'assessment_criteria' => 'nullable|string',
            'resources' => 'nullable|string',
            'references' => 'nullable|string',
            'number_of_periods' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ];
    }
}
