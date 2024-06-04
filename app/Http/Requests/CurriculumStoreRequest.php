<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumStoreRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'department_id' => ['required'],
            'year_start' => ['required', 'integer'],
            'year_end' => ['required', 'integer'],
            'active' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
        ];
    }
}
