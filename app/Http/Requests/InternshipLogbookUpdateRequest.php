<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternshipLogbookUpdateRequest extends FormRequest
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
            'internship_id' => ['required'],
            'date' => ['required', 'date'],
            'activities' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
        ];
    }
}
