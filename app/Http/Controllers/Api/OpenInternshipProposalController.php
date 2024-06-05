<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InternshipProposalCollection;
use App\Models\InternshipProposal;

class OpenInternshipProposalController extends Controller
{
    public function index()
    {
        $internshipProposals = InternshipProposal::where('status', 'open')
            ->get();

        return new InternshipProposalCollection($internshipProposals);
    }
}
