<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisProposalStoreRequest;
use App\Http\Requests\ThesisProposalUpdateRequest;
use App\Http\Resources\ThesisProposalCollection;
use App\Http\Resources\ThesisProposalResource;
use App\Models\ThesisProposal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisProposalController extends Controller
{
    public function index(Request $request): ThesisProposalCollection
    {
        $thesisProposals = ThesisProposal::all();

        return new ThesisProposalCollection($thesisProposals);
    }

    public function store(ThesisProposalStoreRequest $request): ThesisProposalResource
    {
        $thesisProposal = ThesisProposal::create($request->validated());

        return new ThesisProposalResource($thesisProposal);
    }

    public function show(Request $request, ThesisProposal $thesisProposal): ThesisProposalResource
    {
        return new ThesisProposalResource($thesisProposal);
    }

    public function update(ThesisProposalUpdateRequest $request, ThesisProposal $thesisProposal): ThesisProposalResource
    {
        $thesisProposal->update($request->validated());

        return new ThesisProposalResource($thesisProposal);
    }

    public function destroy(Request $request, ThesisProposal $thesisProposal): Response
    {
        $thesisProposal->delete();

        return response()->noContent();
    }
}
