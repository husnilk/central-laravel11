<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisDefenseUpdateRequest extends FormRequest
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
            'thesis_rubric_id' => ['required'],
            'file_report' => ['nullable', 'string'],
            'file_slide' => ['nullable', 'string'],
            'file_journal' => ['nullable', 'string'],
            'status' => ['required', 'integer'],
            'registered_at' => ['required'],
            'method' => ['required', 'integer'],
            'trial_at' => ['nullable', 'date'],
            'start_at' => ['nullable'],
            'end_at' => ['nullable'],
            'room_id' => ['required'],
            'online_url' => ['nullable', 'string'],
            'score' => ['nullable', 'numeric', 'between:-9999999999,9999999999'],
            'grade' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
