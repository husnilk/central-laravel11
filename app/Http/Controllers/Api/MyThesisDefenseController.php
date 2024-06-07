<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisDefense;
use App\Models\ThesisSeminar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyThesisDefenseController extends Controller
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
        $seminar = ThesisDefense::create([
            'thesis_id' => $thesis_id,
            'registered_at' => Carbon::now(),
            'status' => 0,
            'description' => '',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Defense registered successfully',
            'seminar' => $seminar,
        ]);
    }
}
