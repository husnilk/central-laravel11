<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'nik' => ['nullable', 'string'],
            'nim' => ['required', 'string', 'unique:students,nim'],
            'name' => ['required', 'string'],
            'year' => ['nullable', 'integer'],
            'gender' => ['nullable', 'in:M,F'],
            'birthday' => ['nullable', 'date'],
            'birthplace' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'department_id' => ['required'],
            'photo' => ['nullable', 'string'],
            'marital_status' => ['nullable', 'integer'],
            'religion' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'counselor_id' => ['nullable'],
        ];
    }
}
