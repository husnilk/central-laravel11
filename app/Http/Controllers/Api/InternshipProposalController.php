<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternshipProposalStoreRequest;
use App\Http\Requests\InternshipProposalUpdateRequest;
use App\Http\Resources\InternshipProposalCollection;
use App\Http\Resources\InternshipProposalResource;
use App\Models\InternshipProposal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InternshipProposalController extends Controller
{
    public function index(Request $request): InternshipProposalCollection
    {
        $internshipProposals = InternshipProposal::all();

        return new InternshipProposalCollection($internshipProposals);
    }

    public function store(InternshipProposalStoreRequest $request): InternshipProposalResource
    {
        $internshipProposal = InternshipProposal::create($request->validated());

        return new InternshipProposalResource($internshipProposal);
    }

    public function show(Request $request, InternshipProposal $internshipProposal): InternshipProposalResource
    {
        return new InternshipProposalResource($internshipProposal);
    }

    public function update(InternshipProposalUpdateRequest $request, InternshipProposal $internshipProposal): InternshipProposalResource
    {
        $internshipProposal->update($request->validated());

        return new InternshipProposalResource($internshipProposal);
    }

    public function destroy(Request $request, InternshipProposal $internshipProposal): Response
    {
        $internshipProposal->delete();

        return response()->noContent();
    }
}
