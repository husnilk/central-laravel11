<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursePlanDetailUpdateRequest extends FormRequest
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
            'course_plan_id' => ['required'],
            'week' => ['required', 'integer'],
            'course_plan_lo_id' => ['nullable'],
            'grade_indicator' => ['nullable', 'string'],
            'grade_criteria' => ['nullable', 'string'],
            'media' => ['nullable', 'string'],
            'material' => ['nullable', 'string'],
            'reference' => ['nullable', 'string'],
            'method' => ['nullable', 'string'],
            'activity' => ['nullable', 'integer'],
            'est_time' => ['nullable', 'integer'],
            'student_activity' => ['nullable', 'string'],
        ];
    }
}
