<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursePlanAssessmentStoreRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'percentage' => ['required', 'numeric', 'between:-999999.99,999999.99'],
        ];
    }
}
