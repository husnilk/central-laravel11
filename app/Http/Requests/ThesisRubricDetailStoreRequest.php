<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisRubricDetailStoreRequest extends FormRequest
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
            'thesis_rubric_id' => ['required'],
            'description' => ['required', 'string'],
            'percentage' => ['required', 'numeric', 'between:-9999999999,9999999999'],
        ];
    }
}
