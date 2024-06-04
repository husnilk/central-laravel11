<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResearchSchemaStoreRequest;
use App\Http\Requests\ResearchSchemaUpdateRequest;
use App\Http\Resources\ResearchSchemaCollection;
use App\Http\Resources\ResearchSchemaResource;
use App\Models\ResearchSchema;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResearchSchemaController extends Controller
{
    public function index(Request $request): ResearchSchemaCollection
    {
        $researchSchemas = ResearchSchema::all();

        return new ResearchSchemaCollection($researchSchemas);
    }

    public function store(ResearchSchemaStoreRequest $request): ResearchSchemaResource
    {
        $researchSchema = ResearchSchema::create($request->validated());

        return new ResearchSchemaResource($researchSchema);
    }

    public function show(Request $request, ResearchSchema $researchSchema): ResearchSchemaResource
    {
        return new ResearchSchemaResource($researchSchema);
    }

    public function update(ResearchSchemaUpdateRequest $request, ResearchSchema $researchSchema): ResearchSchemaResource
    {
        $researchSchema->update($request->validated());

        return new ResearchSchemaResource($researchSchema);
    }

    public function destroy(Request $request, ResearchSchema $researchSchema): Response
    {
        $researchSchema->delete();

        return response()->noContent();
    }
}
