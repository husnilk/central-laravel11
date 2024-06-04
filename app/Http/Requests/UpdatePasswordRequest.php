<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class UpdatePasswordRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            'password_current' => ['required'],
            'password_new' => ['required', 'min:8'],
            'password_confirm' => ['required', 'same:password_new'],
        ];
    }

    public function messages(): array
    {
        return [
            'password_current.required' => 'Password lama tidak boleh kosong',
            'password_new.required' => 'Password baru tidak boleh kosong',
            'password_new.min' => 'Password baru minimal 8 karakter',
            'password_confirm.required' => 'Konfirmasi password tidak boleh kosong',
            'password_confirm.same' => 'Password tidak cocok',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'failed',
            'message' => 'Validasi gagal',
            'errors' => $validator->errors(),
        ], 400));
    }
}
