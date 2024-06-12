<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\Period;

class MyExamCardController extends Controller
{
    public function show($type)
    {
        $user = auth()->user();
        $student = $user->civitas;
        $period = Period::getActive()->first();
        $enrollment = CourseEnrollment::where('student_id', $user->id)
            ->where('period_id', $period->id)
            ->first();
        if ($enrollment == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No Course Enrollment',
            ], 404);
        }

        if ($type == 'midterm') {
            if ($enrollment->mid_term_passcode == null) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Mid Term Exam Card not approved yet',
                ], 404);
            }
            $passcode = $enrollment->mid_term_passcode;

        } elseif ($type == 'finalterm') {
            if ($enrollment->final_term_passcode == null) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Final Term Exam Card not approved yet',
                ], 404);
            }
            $passcode = $enrollment->final_term_passcode;

        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Card type unknown',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Exam card available',
            'exam_card' => [
                'student_id' => $student->id,
                'name' => $student->name,
                'nim' => $student->nim,
                'year' => $student->year,
                'department' => $student->department->name,
                'photo' => $student->photo,
                'passcode' => $passcode,
            ],
        ]);

    }
}
