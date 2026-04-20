<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonPlanDraftRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'form_id' => ['required', 'integer', 'exists:forms,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'topic_id' => ['required', 'integer', 'exists:topics,id'],
            'subtopic_id' => ['nullable', 'integer', 'exists:subtopics,id'],
            'syllabus_entry_id' => ['nullable', 'integer', 'exists:syllabus_entries,id'],

            'school_name' => ['nullable', 'string', 'max:255'],
            'teacher_name' => ['nullable', 'string', 'max:255'],
            'lesson_date' => ['nullable', 'date'],
            'lesson_time' => ['nullable', 'string', 'max:100'],

            'registered_girls' => ['nullable', 'integer', 'min:0'],
            'registered_boys' => ['nullable', 'integer', 'min:0'],
            'present_girls' => ['nullable', 'integer', 'min:0'],
            'present_boys' => ['nullable', 'integer', 'min:0'],

            'main_competence' => ['nullable', 'string'],
            'specific_competence' => ['nullable', 'string'],
            'main_activity' => ['nullable', 'string'],
            'specific_activity' => ['nullable', 'string'],
            'teaching_learning_resources' => ['nullable', 'string'],
            'references_text' => ['nullable', 'string'],

            'introduction' => ['nullable', 'array'],
            'introduction.time' => ['nullable', 'integer', 'min:0'],
            'introduction.teaching' => ['nullable', 'string'],
            'introduction.learning' => ['nullable', 'string'],
            'introduction.assessment' => ['nullable', 'string'],

            'competence_development' => ['nullable', 'array'],
            'competence_development.time' => ['nullable', 'integer', 'min:0'],
            'competence_development.teaching' => ['nullable', 'string'],
            'competence_development.learning' => ['nullable', 'string'],
            'competence_development.assessment' => ['nullable', 'string'],

            'design_stage' => ['nullable', 'array'],
            'design_stage.time' => ['nullable', 'integer', 'min:0'],
            'design_stage.teaching' => ['nullable', 'string'],
            'design_stage.learning' => ['nullable', 'string'],
            'design_stage.assessment' => ['nullable', 'string'],

            'realisation' => ['nullable', 'array'],
            'realisation.time' => ['nullable', 'integer', 'min:0'],
            'realisation.teaching' => ['nullable', 'string'],
            'realisation.learning' => ['nullable', 'string'],
            'realisation.assessment' => ['nullable', 'string'],

            'remarks' => ['nullable', 'string'],
        ];
    }
}