<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesiStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'topic_id' => ['required'],
            'student_id' => ['required'],
            'title' => ['nullable', 'string'],
            'abstract' => ['nullable', 'string'],
            'start_at' => ['nullable', 'date'],
            'status' => ['required', 'integer'],
            'grade' => ['nullable', 'string'],
            'grade_by' => ['nullable', 'integer'],
            'created_by' => ['required'],
            'thesis_topic_id' => ['required', 'integer', 'exists:thesis_topics,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
