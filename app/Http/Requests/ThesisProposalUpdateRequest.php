<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisProposalUpdateRequest extends FormRequest
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
            'datetime' => ['required'],
            'room_id' => ['nullable'],
            'grade' => ['nullable', 'string'],
            'graded_by' => ['required'],
            'status' => ['required', 'integer'],
            'file_proposal' => ['nullable', 'string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
