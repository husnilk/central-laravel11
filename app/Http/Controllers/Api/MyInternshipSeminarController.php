<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipSeminarAudience;
use Illuminate\Support\Facades\Request;

class MyInternshipSeminarController extends Controller
{
    public function store(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        if ($internship == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found'
            ]);
        }
        $internship->title = $request->title;
        $internship->date = $request->seminar_date;
        $internship->seminar_room_id = $request->room_id;
        $internship->link_seminar = $request->link_seminar;
        $internship->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Seminar saved successfully',
            'internship' => $internship
        ]);
    }

    public function update(Request $request, $internship_id)
    {
        $student = auth()->user()->student;
        $internship = Internship::where('id', $internship_id)
            ->where('student_id', $student->id)
            ->first();
        if ($internship == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found'
            ]);
        }
        $internship->title = $request->title;
        $internship->seminar_notes = $request->seminar_notes;

        $student_ids = $request->student_ids;
        foreach ($student_ids as $student_id) {
            $audience = InternshipSeminarAudience::create([
                'internship_id' => $internship_id,
                'student_id' => $student_id,
                'role' => 'audience'
            ]);
            $internship->students[] = $audience;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Internship Seminar saved successfully',
            'internship' => $internship->students
        ]);

    }
}
