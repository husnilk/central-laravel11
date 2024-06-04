<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationStoreRequest;
use App\Http\Requests\PublicationUpdateRequest;
use App\Http\Resources\PublicationCollection;
use App\Http\Resources\PublicationResource;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublicationController extends Controller
{
    public function index(Request $request): PublicationCollection
    {
        $publications = Publication::all();

        return new PublicationCollection($publications);
    }

    public function store(PublicationStoreRequest $request): PublicationResource
    {
        $publication = Publication::create($request->validated());

        return new PublicationResource($publication);
    }

    public function show(Request $request, Publication $publication): PublicationResource
    {
        return new PublicationResource($publication);
    }

    public function update(PublicationUpdateRequest $request, Publication $publication): PublicationResource
    {
        $publication->update($request->validated());

        return new PublicationResource($publication);
    }

    public function destroy(Request $request, Publication $publication): Response
    {
        $publication->delete();

        return response()->noContent();
    }
}
