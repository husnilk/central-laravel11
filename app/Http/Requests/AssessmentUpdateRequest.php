<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentUpdateRequest extends FormRequest
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
            'assessment_detail_id' => ['required'],
            'course_enrollment_detail_id' => ['required'],
            'grade' => ['required', 'numeric', 'between:-999999.99,999999.99'],
        ];
    }
}
