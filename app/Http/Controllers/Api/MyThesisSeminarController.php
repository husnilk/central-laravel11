<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarReviewer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyThesisSeminarController extends Controller
{
    public function store(Request $request, $thesis_id)
    {
        $lecturers_id = Lecturer::all()
            ->pluck('id', 'id')
            ->toArray();
        $student = auth()->user()->student;
        $thesis = Thesis::where('id', $thesis_id)
            ->where('student_id', $student->id)
            ->get();

        if (is_null($thesis)) {
            return response()->json($this->isnotfound());
        }
        $seminar = ThesisSeminar::where('thesis_id', $thesis_id)
            ->where('status', 1)
            ->first();

        if ($seminar != null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'You already registerd',
            ]);
        }
        $seminar = ThesisSeminar::create([
            'thesis_id' => $thesis_id,
            'registered_at' => Carbon::now(),
            'status' => 1,
            'description' => '',
        ]);

        ThesisSeminarReviewer::create([
            'thesis_seminar_id' => $seminar->id,
            'reviewer_id' => array_rand($lecturers_id),
            'status' => 1,
            'position' => 'Penguji',
        ]);
        ThesisSeminarReviewer::create([
            'thesis_seminar_id' => $seminar->id,
            'reviewer_id' => array_rand($lecturers_id),
            'status' => 1,
            'position' => 'Penguji',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Seminar registered successfully',
            'seminar' => $seminar,
        ]);
    }

    public function show($thesis_id, $id)
    {
        $student = auth()->user()->student;
        $seminar = ThesisSeminar::with('thesis', 'reviewers', 'audiences')
            ->where('thesis_id', $thesis_id)
            ->where('id', $id)
            ->get();

        if (is_null($seminar)) {
            return response()->json($this->isnotfound());
        }

        return response()->json($seminar);

    }
}
