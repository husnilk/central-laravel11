<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursePlanDetailActivityUpdateRequest extends FormRequest
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
            'course_plan_detail_id' => ['required'],
            'activity' => ['required', 'integer'],
            'method' => ['nullable', 'string'],
            'est_time' => ['nullable', 'integer'],
            'student_activity' => ['required', 'string'],
        ];
    }
}
