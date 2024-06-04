<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisDefenseExaminerStoreRequest extends FormRequest
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
            'thesis_defense_id' => ['required'],
            'examiner_id' => ['required'],
            'status' => ['required', 'integer'],
            'position' => ['required', 'integer'],
            'notes' => ['nullable', 'string'],
            'lecturer_id' => ['required', 'integer', 'exists:lecturers,id'],
        ];
    }
}
