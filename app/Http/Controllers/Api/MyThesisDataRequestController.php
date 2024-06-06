<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisDataRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyThesisDataRequestController extends Controller
{
    public function store(Request $request, $thesis_id){
        $student = auth()->user()->student;
        $thesis = Thesis::where('id' , $thesis_id)
            ->where('student_id', $student->id)
            ->first();

        if($thesis == null){
            return response()->json($this->isnotfound());
        }

        $data_request = new ThesisDataRequest();
        $data_request->thesis_id = $thesis_id;
        $data_request->supervisor_id = $request->supervisor_id;
        $data_request->request_at = Carbon::now();
        $data_request->requested_data = $request->requested_data;
        $data_request->request_to_person = $request->to;
        $data_request->request_to_position = $request->position;
        $data_request->request_to_org = $request->organization;
        $data_request->request_to_address = $request->address;
        $data_request->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Request submitted successfully',
            'data_request' => $data_request
        ]);
    }
}
