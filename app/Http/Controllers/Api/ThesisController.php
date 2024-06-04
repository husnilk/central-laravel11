<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisStoreRequest;
use App\Http\Requests\ThesisUpdateRequest;
use App\Http\Resources\ThesiCollection;
use App\Http\Resources\ThesiResource;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisController extends Controller
{
    public function index(Request $request): ThesiCollection
    {
        $thesis = Thesi::all();

        return new ThesiCollection($thesis);
    }

    public function store(ThesisStoreRequest $request): ThesiResource
    {
        $thesi = Thesi::create($request->validated());

        return new ThesiResource($thesi);
    }

    public function show(Request $request, Thesi $thesi): ThesiResource
    {
        return new ThesiResource($thesi);
    }

    public function update(ThesisUpdateRequest $request, Thesi $thesi): ThesiResource
    {
        $thesi->update($request->validated());

        return new ThesiResource($thesi);
    }

    public function destroy(Request $request, Thesi $thesi): Response
    {
        $thesi->delete();

        return response()->noContent();
    }
}
