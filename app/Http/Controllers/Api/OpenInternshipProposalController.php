<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InternshipProposalCollection;
use App\Models\InternshipProposal;

class OpenInternshipProposalController extends Controller
{
    public function index()
    {

        $proposals = InternshipProposal::where('status', 'open')
            ->get();

        $openProposals = [];
        foreach($proposals as $proposal){
            $openProposals[] = [
                'company_name' => $proposal->company->name,
                'title' => $proposal->title,
                'job_desc' => $proposal->job_desc,
                'start_at' => $proposal->start_at,
                'end_at' => $proposal->end_at
            ];
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Open internship retrieved successfully',
            'proposals' => $openProposals
        ]);
    }
}
