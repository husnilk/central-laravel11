<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherStoreRequest;
use App\Http\Requests\PublisherUpdateRequest;
use App\Http\Resources\PublisherCollection;
use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublisherController extends Controller
{
    public function index(Request $request): PublisherCollection
    {
        $publishers = Publisher::all();

        return new PublisherCollection($publishers);
    }

    public function store(PublisherStoreRequest $request): PublisherResource
    {
        $publisher = Publisher::create($request->validated());

        return new PublisherResource($publisher);
    }

    public function show(Request $request, Publisher $publisher): PublisherResource
    {
        return new PublisherResource($publisher);
    }

    public function update(PublisherUpdateRequest $request, Publisher $publisher): PublisherResource
    {
        $publisher->update($request->validated());

        return new PublisherResource($publisher);
    }

    public function destroy(Request $request, Publisher $publisher): Response
    {
        $publisher->delete();

        return response()->noContent();
    }
}
