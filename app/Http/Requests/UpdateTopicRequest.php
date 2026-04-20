<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopicRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject_id' => 'required|exists:subjects,id',
            'form_id' => 'required|exists:forms,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:topics,slug,' . $this->topic->id,
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ];
    }
}
