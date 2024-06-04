<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CounsellingLogbookUpdateRequest extends FormRequest
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
            'counsellor_id' => ['required'],
            'counselling_topic_id' => ['required'],
            'period_id' => ['required'],
            'date' => ['required', 'date'],
            'status' => ['required', 'integer'],
            'file' => ['nullable', 'string'],
            'counselling_category_id' => ['required', 'integer', 'exists:counselling_categories,id'],
        ];
    }
}
