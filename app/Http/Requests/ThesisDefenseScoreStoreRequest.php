<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisDefenseScoreStoreRequest extends FormRequest
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
            'thesis_defense_examiner_id' => ['required'],
            'thesis_rubric_detail_id' => ['required'],
            'score' => ['nullable', 'numeric', 'between:-9999999999,9999999999'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
