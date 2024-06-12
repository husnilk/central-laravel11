<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;

class MyInternshipController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $internships = Internship::where('student_id', $user->id)
            ->get();

        $internships_response = [];
        foreach ($internships as $internship) {
            $internships_response[] = [
                'id' => $internship->id,
                'title' => $internship->report_title,
                'company' => $internship->proposal->company->name,
                'start_at' => $internship->start_at,
                'end_at' => $internship->end_at,
                'status' => $internship->status,
                'grade' => $internship->grade ?? '-',
                'lecturer' => $internship->lecturer->name ?? '-',
            ];
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Welcome to MyInternship API',
            'internships' => $internships_response,
        ]);
    }

    public function show(Request $request, $internship_id)
    {
        $user = auth()->user();
        $internship = Internship::with('proposal.company')
            ->where('student_id', $user->id)
            ->where('id', $internship_id)
            ->first();

        return response()->json($internship);
    }
}
