<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassCourseStoreRequest extends FormRequest
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
            'course_id' => ['required'],
            'period_id' => ['required'],
            'course_plan_id' => ['required'],
            'name' => ['required', 'string'],
            'course_code' => ['nullable', 'string'],
            'course_name' => ['nullable', 'string'],
            'course_credits' => ['nullable', 'integer'],
            'course_semester' => ['nullable', 'integer'],
            'meeting_nonconformity' => ['nullable', 'string'],
            'meeting_verified' => ['nullable'],
        ];
    }
}
