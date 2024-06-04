<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounsellingTopicStoreRequest;
use App\Http\Requests\CounsellingTopicUpdateRequest;
use App\Http\Resources\CounsellingTopicCollection;
use App\Http\Resources\CounsellingTopicResource;
use App\Models\CounsellingTopic;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CounsellingTopicController extends Controller
{
    public function index(Request $request): CounsellingTopicCollection
    {
        $counsellingTopics = CounsellingTopic::all();

        return new CounsellingTopicCollection($counsellingTopics);
    }

    public function store(CounsellingTopicStoreRequest $request): CounsellingTopicResource
    {
        $counsellingTopic = CounsellingTopic::create($request->validated());

        return new CounsellingTopicResource($counsellingTopic);
    }

    public function show(Request $request, CounsellingTopic $counsellingTopic): CounsellingTopicResource
    {
        return new CounsellingTopicResource($counsellingTopic);
    }

    public function update(CounsellingTopicUpdateRequest $request, CounsellingTopic $counsellingTopic): CounsellingTopicResource
    {
        $counsellingTopic->update($request->validated());

        return new CounsellingTopicResource($counsellingTopic);
    }

    public function destroy(Request $request, CounsellingTopic $counsellingTopic): Response
    {
        $counsellingTopic->delete();

        return response()->noContent();
    }
}
