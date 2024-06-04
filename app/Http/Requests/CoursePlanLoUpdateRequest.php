<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursePlanLoUpdateRequest extends FormRequest
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
            'curriculum_indicator_id' => ['required'],
            'code' => ['required', 'string'],
            'name' => ['required', 'string'],
        ];
    }
}
