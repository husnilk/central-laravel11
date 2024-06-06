<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Support\Facades\Request;

class MyInternshipSeminarController extends Controller
{
    public function store(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        if ($internship == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data not found'
            ]);
        }
        $internship->title = $request->title;
        $internship->date = $request->seminar_date;
        $internship->seminar_room_id = $request->room_id;
        $internship->link_seminar = $request->link_seminar;
        $internship->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Seminar saved successfully',
            'internship' => $internship
        ]);
    }
}
