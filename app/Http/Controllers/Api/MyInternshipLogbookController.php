<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipLogbook;
use Illuminate\Http\Request;

class MyInternshipLogbookController extends Controller
{
    public function index($id)
    {
        $user = auth()->user();
        $internship = Internship::where('id', $id)
            ->where('student_id', $user->id)
            ->first();

        if ($internship == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internship not found',
            ], 404);
        }
        $logs = $internship->logs;

        return response()->json([
            'status' => 'success',
            'message' => 'Logbook retrieved successfully',
            'count' => $logs->count(),
            'logs' => $logs,
        ]);
    }

    public function store(Request $request, $id)
    {

        $student = auth()->user()->student;
        $internship = Internship::whereId($id)
            ->where('student_id', $student->id)
            ->first();

        if ($internship == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internship not found',
            ], 404);
        }

        $log = InternshipLogbook::create([
            'internship_id' => $id,
            'date' => $request->date,
            'activities' => $request->activities,
            'note' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Logbook saved successfully',
            'log' => $log,
        ]);
    }

    public function update(Request $request, $intern_id, $id)
    {
        $student = auth()->user()->student;
        $internship = Internship::whereId($intern_id)
            ->where('student_id', $student->id)
            ->first();

        if ($internship == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Internship not found',
            ], 404);
        }

        $log = InternshipLogbook::where('id', $id)
            ->where('internship_id', $intern_id)
            ->first();

        $log->update([
            'date' => $request->date,
            'activities' => $request->activities,
            'note' => null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Logbook updated successfully',
            'log' => $log,
        ]);
    }

    public function send(Request $request, $intern_id){

        $request->validate([
            'email' => 'required|email'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Internship logbook send successfully'
        ]);
    }
}
