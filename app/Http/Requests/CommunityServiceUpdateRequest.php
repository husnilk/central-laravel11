<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommunityServiceUpdateRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'community_service_schema_id' => ['required'],
            'partner' => ['nullable', 'string'],
            'start_at' => ['nullable', 'integer'],
            'fund_amount' => ['nullable', 'integer'],
            'proposal_file' => ['nullable', 'string'],
            'report_file' => ['nullable', 'string'],
        ];
    }
}
