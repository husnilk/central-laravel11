<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentRubricUpdateRequest extends FormRequest
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
            'assessment_criteria_id' => ['required'],
            'rubric' => ['nullable', 'string'],
            'grade' => ['required', 'numeric', 'between:-999999.99,999999.99'],
        ];
    }
}
