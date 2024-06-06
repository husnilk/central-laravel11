<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use Illuminate\Http\Request;

class MyThesisLogController extends Controller
{
    public function index($thesis_id){
        $student = auth()->user()->student;
        $thesis = Thesis::where('id', $thesis_id)
            ->where('student_id', $student)
            ->first();

        if(is_null($thesis)){
            return response()->json($this->isnotfound());
        }

        $logs = $thesis->logs;

        return response()->json([
            'status' => 'success',
            'message' => 'Thesis Log retrieved successfully',
            'count' => $logs->count(),
            'logs' => $logs
        ]);
    }

    public function store(Request $request, $thesis_id)
    {
        $student = auth()->user()->student;
        $thesis = Thesis::where('id', $thesis_id)
            ->where('student_id', $student)
            ->first();

        if(is_null($thesis)){
            return response()->json($this->isnotfound());
        }

        $log = new ThesisLogbook();
        $log->thesis_id = $thesis_id;
        $log->supervisor_id = $request->supervisor_id;
        $log->date = $request->date;
        $log->progress = $request->progress;
        $log->status = 0;
        $log->save();

        return response()->json([
            'status' => 'success',
            'message' => ''
        ])
    }
}
