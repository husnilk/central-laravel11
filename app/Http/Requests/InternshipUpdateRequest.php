<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternshipUpdateRequest extends FormRequest
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
            'internship_proposal_id' => ['required'],
            'student_id' => ['required'],
            'advisor_id' => ['nullable'],
            'status' => ['required', 'in:accepted,rejected,ongoing,seminar,administration,finished,cancelled'],
            'start_at' => ['required', 'date'],
            'end_at' => ['nullable', 'date'],
            'report_title' => ['nullable', 'string'],
            'seminar_date' => ['nullable', 'date'],
            'seminar_room_id' => ['required'],
            'link_seminar' => ['nullable', 'string'],
            'seminar_deadline' => ['nullable', 'date'],
            'attendees_list' => ['nullable', 'string'],
            'internship_score' => ['nullable', 'string'],
            'activity_report' => ['nullable', 'string'],
            'news_event' => ['nullable', 'string'],
            'work_report' => ['nullable', 'string'],
            'certificate' => ['nullable', 'string'],
            'report_receipt' => ['nullable', 'string'],
            'grade' => ['nullable', 'string'],
            'lecturer_id' => ['required', 'integer', 'exists:lecturers,id'],
        ];
    }
}
