<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumIndicatorUpdateRequest extends FormRequest
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
            'curriculum_plo_id' => ['required'],
            'code' => ['required', 'string'],
            'indicator' => ['required', 'string'],
            'min_grade' => ['required', 'integer'],
        ];
    }
}
