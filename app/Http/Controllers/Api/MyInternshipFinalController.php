<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;

class MyInternshipFinalController extends Controller
{
    public function store(Request $request, $internship_id)
    {
        $student = auth()->user()->student;

        $internship = Internship::where('id', $internship_id)
            ->where('student_id', $student->id)
            ->first();

        if($internship == null){
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found'
            ]);
        }


    }
}
