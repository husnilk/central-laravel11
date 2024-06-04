<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisTopicStoreRequest;
use App\Http\Requests\ThesisTopicUpdateRequest;
use App\Http\Resources\ThesisTopicCollection;
use App\Http\Resources\ThesisTopicResource;
use App\Models\ThesisTopic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisTopicController extends Controller
{
    public function index(Request $request): ThesisTopicCollection
    {
        $thesisTopics = ThesisTopic::all();

        return new ThesisTopicCollection($thesisTopics);
    }

    public function store(ThesisTopicStoreRequest $request): ThesisTopicResource
    {
        $thesisTopic = ThesisTopic::create($request->validated());

        return new ThesisTopicResource($thesisTopic);
    }

    public function show(Request $request, ThesisTopic $thesisTopic): ThesisTopicResource
    {
        return new ThesisTopicResource($thesisTopic);
    }

    public function update(ThesisTopicUpdateRequest $request, ThesisTopic $thesisTopic): ThesisTopicResource
    {
        $thesisTopic->update($request->validated());

        return new ThesisTopicResource($thesisTopic);
    }

    public function destroy(Request $request, ThesisTopic $thesisTopic): Response
    {
        $thesisTopic->delete();

        return response()->noContent();
    }
}
