<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisSeminarStoreRequest;
use App\Http\Requests\ThesisSeminarUpdateRequest;
use App\Http\Resources\ThesisSeminarCollection;
use App\Http\Resources\ThesisSeminarResource;
use App\Models\ThesisSeminar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisSeminarController extends Controller
{
    public function index(Request $request): ThesisSeminarCollection
    {
        $thesisSeminars = ThesisSeminar::all();

        return new ThesisSeminarCollection($thesisSeminars);
    }

    public function store(ThesisSeminarStoreRequest $request): ThesisSeminarResource
    {
        $thesisSeminar = ThesisSeminar::create($request->validated());

        return new ThesisSeminarResource($thesisSeminar);
    }

    public function show(Request $request, ThesisSeminar $thesisSeminar): ThesisSeminarResource
    {
        return new ThesisSeminarResource($thesisSeminar);
    }

    public function update(ThesisSeminarUpdateRequest $request, ThesisSeminar $thesisSeminar): ThesisSeminarResource
    {
        $thesisSeminar->update($request->validated());

        return new ThesisSeminarResource($thesisSeminar);
    }

    public function destroy(Request $request, ThesisSeminar $thesisSeminar): Response
    {
        $thesisSeminar->delete();

        return response()->noContent();
    }
}
