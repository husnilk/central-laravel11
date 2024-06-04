<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassMeetingUpdateRequest extends FormRequest
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
            'meet_no' => ['required', 'integer'],
            'class_id' => ['required'],
            'course_plan_detail_id' => ['required'],
            'class_lecturer_id' => ['required'],
            'material_real' => ['required', 'string'],
            'assessment_real' => ['required', 'string'],
            'method' => ['required', 'integer'],
            'ol_platform' => ['nullable', 'string'],
            'ol_links' => ['nullable', 'string'],
            'room_id' => ['nullable'],
            'meeting_start_at' => ['nullable'],
            'meeting_end_at' => ['nullable'],
            'class_course_id' => ['required', 'integer', 'exists:class_courses,id'],
            'lecturer_id' => ['required', 'integer', 'exists:lecturers,id'],
        ];
    }
}
