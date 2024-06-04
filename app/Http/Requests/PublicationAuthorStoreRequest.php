<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationAuthorStoreRequest extends FormRequest
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
            'publication_id' => ['required'],
            'user_id' => ['required'],
            'position' => ['required', 'integer'],
            'corresponding' => ['required', 'integer'],
        ];
    }
}
