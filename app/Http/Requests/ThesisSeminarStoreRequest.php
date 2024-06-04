<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisSeminarStoreRequest extends FormRequest
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
            'registered_at' => ['nullable'],
            'method' => ['required', 'integer'],
            'seminar_at' => ['nullable'],
            'room_id' => ['nullable'],
            'online_url' => ['nullable', 'string'],
            'file_report' => ['nullable', 'string'],
            'file_slide' => ['nullable', 'string'],
            'file_journal' => ['nullable', 'string'],
            'file_attendance' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'integer'],
            'status' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
        ];
    }
}
