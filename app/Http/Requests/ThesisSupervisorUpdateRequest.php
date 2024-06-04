<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisSupervisorUpdateRequest extends FormRequest
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
            'lecturer_id' => ['required'],
            'position' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'created_by' => ['required'],
        ];
    }
}
