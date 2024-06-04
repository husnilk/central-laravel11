<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoursePlanReferenceStoreRequest extends FormRequest
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
            'course_plan_id' => ['required'],
            'title' => ['required', 'string'],
            'author' => ['required', 'string'],
            'publisher' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'primary' => ['required', 'integer'],
        ];
    }
}
