<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubtopicRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:subtopics,slug,' . $this->subtopic->id,
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ];
    }
}
