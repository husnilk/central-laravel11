<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class MyThesisController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        $theses = Thesis::where('student_id', $student->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Theses retrieved successfully',
            'count' => $theses->count(),
            'theses' => $theses
        ]);
    }

    public function store(Request $request)
    {
        $student = auth()->user()->student;
        $thesis = new Thesis();
        $thesis->topic_id = $request->topid_id;
        $thesis->student_id = $student->id;
        $thesis->title = $request->title;
        $thesis->abstract = $request->abstract;
        $thesis->created_by = auth()->user()->id;
        $thesis->status = "proposed";
        $thesis->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Thesis registered successfully',
            'thesis' => $thesis
        ]);
    }

    public function show($thesis_id){
        $student = auth()->user()->student;
        $thesis = Thesis::where('student_id', $student->id)
            ->where('id', $thesis_id)
            ->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Thesis data retrieved successfully',
            'thesis' => $thesis
        ]);
    }

    public function update(Request $request, $thesis_id)
    {
        $student = auth()->user()->student;
        $thesis = Thesis::where('student_id', $student->id)
            ->where('id', $thesis_id)
            ->first();

        $thesis->topic_id = $request->topid_id;
        $thesis->title = $request->title;
        $thesis->abstract = $request->abstract;
        $thesis->status = "proposed";
        $thesis->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Thesis updated successfully',
            'thesis' => $thesis
        ]);
    }
}
