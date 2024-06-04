<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResearchStoreRequest;
use App\Http\Requests\ResearchUpdateRequest;
use App\Http\Resources\ResearchCollection;
use App\Http\Resources\ResearchResource;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResearchController extends Controller
{
    public function index(Request $request): ResearchCollection
    {
        $research = Research::all();

        return new ResearchCollection($research);
    }

    public function store(ResearchStoreRequest $request): ResearchResource
    {
        $research = Research::create($request->validated());

        return new ResearchResource($research);
    }

    public function show(Request $request, Research $research): ResearchResource
    {
        return new ResearchResource($research);
    }

    public function update(ResearchUpdateRequest $request, Research $research): ResearchResource
    {
        $research->update($request->validated());

        return new ResearchResource($research);
    }

    public function destroy(Request $request, Research $research): Response
    {
        $research->delete();

        return response()->noContent();
    }
}
