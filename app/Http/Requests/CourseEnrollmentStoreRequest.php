<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseEnrollmentStoreRequest extends FormRequest
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
            'student_id' => ['required'],
            'period_id' => ['required'],
            'counselor_id' => ['required'],
            'status' => ['required', 'integer'],
            'mid_term_passcode' => ['nullable', 'string'],
            'final_term_passcode' => ['nullable', 'string'],
            'registered_at' => ['required', 'date'],
            'gpa' => ['required', 'numeric', 'between:-999999.99,999999.99'],
        ];
    }
}
