<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipProposal;
use Illuminate\Http\Request;

class MyInternshipProposalController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $proposal = InternshipProposal::create([
            'company_id' => $request->company_id,
            'type' => 1,
            'title' => $request->title,
            'job_desc' => $request->job_desc,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'status' => 'open',
        ]);

        $student_ids = $request->students;
        foreach ($student_ids as $student_id) {
            $internship = Internship::create([
                'internship_proposal_id' => $proposal->id,
                'student_id' => $student_id,
                'status' => 'accepted',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Internship Proposal saved successfully',
            'proposal' => $proposal]
        );
    }

    public function update(Request $request, $id)
    {
        $proposal = InternshipProposal::find($id);
        if ($proposal == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Proposal not found',
            ], 404);
        }

        $proposal->update([
            'company_id' => $request->company_id,
            'title' => $request->title,
            'job_desc' => $request->job_desc,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        Internship::where('internship_proposal_id', $proposal->id)
            ->delete();

        $student_ids = $request->students;
        foreach ($student_ids as $student_id) {
            $internship = Internship::create([
                'internship_proposal_id' => $proposal->id,
                'student_id' => $student_id,
                'status' => 'accepted',
            ]);
        }
        $proposal = InternshipProposal::with('internships')->find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Internship Proposal saved successfully',
            'proposal' => $proposal,
        ]);
    }
}
