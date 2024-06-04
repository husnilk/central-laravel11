<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisProposalAudienceStoreRequest;
use App\Http\Requests\ThesisProposalAudienceUpdateRequest;
use App\Http\Resources\ThesisProposalAudienceCollection;
use App\Http\Resources\ThesisProposalAudienceResource;
use App\Models\ThesisProposalAudience;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisProposalAudienceController extends Controller
{
    public function index(Request $request): ThesisProposalAudienceCollection
    {
        $thesisProposalAudiences = ThesisProposalAudience::all();

        return new ThesisProposalAudienceCollection($thesisProposalAudiences);
    }

    public function store(ThesisProposalAudienceStoreRequest $request): ThesisProposalAudienceResource
    {
        $thesisProposalAudience = ThesisProposalAudience::create($request->validated());

        return new ThesisProposalAudienceResource($thesisProposalAudience);
    }

    public function show(Request $request, ThesisProposalAudience $thesisProposalAudience): ThesisProposalAudienceResource
    {
        return new ThesisProposalAudienceResource($thesisProposalAudience);
    }

    public function update(ThesisProposalAudienceUpdateRequest $request, ThesisProposalAudience $thesisProposalAudience): ThesisProposalAudienceResource
    {
        $thesisProposalAudience->update($request->validated());

        return new ThesisProposalAudienceResource($thesisProposalAudience);
    }

    public function destroy(Request $request, ThesisProposalAudience $thesisProposalAudience): Response
    {
        $thesisProposalAudience->delete();

        return response()->noContent();
    }
}
