<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursePlanStoreRequest extends FormRequest
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
            'course_id' => ['required'],
            'rev' => ['required', 'integer'],
            'code' => ['required', 'string'],
            'name' => ['required', 'string'],
            'alias_name' => ['nullable', 'string'],
            'credit' => ['required', 'integer'],
            'semester' => ['required', 'integer'],
            'mandatory' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'ilearn_url' => ['nullable', 'string'],
            'validated_by' => ['nullable'],
            'validated_at' => ['nullable'],
            'learning_strategy' => ['nullable', 'string'],
            'learning_management' => ['nullable', 'string'],
            'participant' => ['nullable', 'string'],
            'class_observation' => ['nullable', 'string'],
            'constraint' => ['nullable', 'string'],
            'improvement' => ['nullable', 'string'],
        ];
    }
}
