<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassAttendanceUpdateRequest extends FormRequest
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
            'course_enrollment_detail_id' => ['required'],
            'class_meeting_id' => ['required'],
            'status' => ['required', 'integer'],
            'meet_no' => ['required', 'integer'],
            'device_id' => ['nullable', 'string'],
            'device_name' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'attendance_status' => ['required', 'integer'],
            'need_attention' => ['required', 'integer'],
            'information' => ['required', 'string'],
            'permit_reason' => ['nullable', 'string'],
            'permit_file' => ['nullable', 'string'],
            'rating' => ['nullable', 'numeric'],
            'feedback' => ['nullable', 'string'],
        ];
    }
}
