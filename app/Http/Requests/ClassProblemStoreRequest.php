<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassProblemStoreRequest extends FormRequest
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
            'class_course_id' => ['required'],
            'course_enrollment_detail_id' => ['required'],
            'problem' => ['required', 'string'],
            'solution' => ['nullable', 'string'],
        ];
    }
}
