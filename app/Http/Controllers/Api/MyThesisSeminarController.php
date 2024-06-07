<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyThesisSeminarController extends Controller
{
    public function store(Request $request, $thesis_id)
    {
        $student = auth()->user()->student;
        $thesis = Thesis::where('id', $thesis_id)
            ->where('student_id', $student->id)
            ->get();

        if (is_null($thesis)) {
            return response()->json($this->isnotfound());
        }
        $seminar = ThesisSeminar::create([
            'thesis_id' => $thesis_id,
            'registered_at' => Carbon::now(),
            'status' => 0,
            'description' => '',
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
        $seminar = ThesisSeminar::where('id', $thesis_id)
            ->where('id', $id)
            ->get();

        if (is_null($seminar)) {
            return response()->json($this->isnotfound());
        }

        return response()->json($seminar);

    }
}
