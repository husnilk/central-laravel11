<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResearchMemberStoreRequest;
use App\Http\Requests\ResearchMemberUpdateRequest;
use App\Http\Resources\ResearchMemberCollection;
use App\Http\Resources\ResearchMemberResource;
use App\Models\ResearchMember;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResearchMemberController extends Controller
{
    public function index(Request $request): ResearchMemberCollection
    {
        $researchMembers = ResearchMember::all();

        return new ResearchMemberCollection($researchMembers);
    }

    public function store(ResearchMemberStoreRequest $request): ResearchMemberResource
    {
        $researchMember = ResearchMember::create($request->validated());

        return new ResearchMemberResource($researchMember);
    }

    public function show(Request $request, ResearchMember $researchMember): ResearchMemberResource
    {
        return new ResearchMemberResource($researchMember);
    }

    public function update(ResearchMemberUpdateRequest $request, ResearchMember $researchMember): ResearchMemberResource
    {
        $researchMember->update($request->validated());

        return new ResearchMemberResource($researchMember);
    }

    public function destroy(Request $request, ResearchMember $researchMember): Response
    {
        $researchMember->delete();

        return response()->noContent();
    }
}
