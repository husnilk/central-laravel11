<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffStoreRequest extends FormRequest
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
            'nik' => ['required', 'string'],
            'name' => ['required', 'string'],
            'nip' => ['nullable', 'string'],
            'karpeg' => ['nullable', 'string'],
            'npwp' => ['nullable', 'string'],
            'gender' => ['nullable', 'in:M,F'],
            'birthday' => ['nullable', 'date'],
            'birthplace' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'department_id' => ['required'],
            'photo' => ['nullable', 'string'],
            'marital_status' => ['nullable', 'integer'],
            'religion' => ['nullable', 'integer'],
            'association_type' => ['nullable', 'integer'],
            'status' => ['required', 'integer'],
        ];
    }
}
