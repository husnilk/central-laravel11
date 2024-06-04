<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternshipProposalStoreRequest extends FormRequest
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
            'company_id' => ['required'],
            'type' => ['required', 'integer'],
            'title' => ['required', 'string'],
            'job_desc' => ['nullable', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date'],
            'status' => ['required', 'in:draft,open,'],
            'note' => ['nullable', 'string'],
            'active' => ['required', 'integer'],
            'response_letter' => ['nullable', 'string'],
            'background' => ['nullable', 'string'],
            'internship_company_id' => ['required', 'integer', 'exists:internship_companies,id'],
        ];
    }
}
