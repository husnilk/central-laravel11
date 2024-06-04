<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisLogbookStoreRequest extends FormRequest
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
            'thesis_id' => ['required'],
            'supervisor_id' => ['required'],
            'date' => ['required', 'date'],
            'progress' => ['required', 'string'],
            'problem' => ['nullable', 'string'],
            'file_progress' => ['nullable', 'string'],
            'supervised_by' => ['nullable'],
            'supervised_at' => ['nullable'],
            'notes' => ['nullable', 'string'],
            'file_notes' => ['nullable', 'string'],
            'status' => ['required', 'integer'],
            'thesis_supervisor_id' => ['required', 'integer', 'exists:thesis_supervisors,id'],
        ];
    }
}
