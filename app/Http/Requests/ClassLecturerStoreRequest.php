<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassLecturerStoreRequest extends FormRequest
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
            'class_id' => ['required'],
            'lecturer_id' => ['required'],
            'position' => ['required', 'integer'],
            'grading' => ['required', 'integer'],
            'class_course_id' => ['required', 'integer', 'exists:class_courses,id'],
        ];
    }
}
