<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CounsellingLogbook;
use App\Models\CounsellingLogbookDetail;
use App\Models\Period;
use App\Models\User;
use Illuminate\Http\Request;

class MyCounsellingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $counsellings = CounsellingLogbook::with('details', 'topic')
            ->where('student_id', $user->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil mendapatkan data bimbingan akademik',
            'counts' => $counsellings->count(),
            'counsellings' => $counsellings,
        ]);
    }

    public function show($id)
    {
        $user = auth()->user();
        $counseling = CounsellingLogbook::where('student_id', $user->id)
            ->where('id', $id)
            ->first();

        if ($counseling == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found',
            ], 404);
        }

        return response()->json($counseling);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->type == User::STUDENT) {
            $counsellor_id = $user->student->counselor_id;
        } else {
            $counsellor_id = $user->id;
        }
        $period = Period::getActive()->first();

        $counselling = new CounsellingLogbook();
        $counselling->student_id = $user->id;
        $counselling->period_id = $period->id;
        $counselling->counsellor_id = $counsellor_id;
        $counselling->counselling_topic_id = request()->topic_id;
        $counselling->date = request()->date;
        $counselling->status = 1;
        $counselling->save();

        $counsellingDetail = new CounsellingLogbookDetail();
        $counsellingDetail->no = 1;
        $counsellingDetail->counselling_logbook_id = $counselling->id;
        $counsellingDetail->user_id = $user->id;
        $counsellingDetail->description = $request->description;
        $counsellingDetail->save();

        $counselling->detail = [
            $counsellingDetail,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Counselling data saved successfully',
            'counselling' => $counselling,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $counselling = CounsellingLogbook::with('details')
            ->where('student_id', $user->id)
            ->where('id', $id)
            ->first();

        $counselling->date = $request->date;
        $counselling->counselling_topic_id = $request->topic_id;
        $counselling->save();

        $counsellingDetail = $counselling->details->first();
        $counsellingDetail->description = $request->description;
        $counsellingDetail->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Counselling data saved successfully',
            'counselling' => $counselling,
        ]);
    }
}
