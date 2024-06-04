<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
            'building_id' => ['required'],
            'name' => ['required', 'string'],
            'floor' => ['nullable', 'integer'],
            'number' => ['nullable', 'integer'],
            'capacity' => ['nullable', 'integer'],
            'size' => ['nullable', 'integer'],
            'location' => ['nullable', 'string'],
            'public' => ['nullable', 'integer'],
            'status' => ['nullable', 'integer'],
            'availability' => ['required', 'integer'],
        ];
    }
}
