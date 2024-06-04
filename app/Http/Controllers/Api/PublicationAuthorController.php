<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationAuthorStoreRequest;
use App\Http\Requests\PublicationAuthorUpdateRequest;
use App\Http\Resources\PublicationAuthorCollection;
use App\Http\Resources\PublicationAuthorResource;
use App\Models\PublicationAuthor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublicationAuthorController extends Controller
{
    public function index(Request $request): PublicationAuthorCollection
    {
        $publicationAuthors = PublicationAuthor::all();

        return new PublicationAuthorCollection($publicationAuthors);
    }

    public function store(PublicationAuthorStoreRequest $request): PublicationAuthorResource
    {
        $publicationAuthor = PublicationAuthor::create($request->validated());

        return new PublicationAuthorResource($publicationAuthor);
    }

    public function show(Request $request, PublicationAuthor $publicationAuthor): PublicationAuthorResource
    {
        return new PublicationAuthorResource($publicationAuthor);
    }

    public function update(PublicationAuthorUpdateRequest $request, PublicationAuthor $publicationAuthor): PublicationAuthorResource
    {
        $publicationAuthor->update($request->validated());

        return new PublicationAuthorResource($publicationAuthor);
    }

    public function destroy(Request $request, PublicationAuthor $publicationAuthor): Response
    {
        $publicationAuthor->delete();

        return response()->noContent();
    }
}
