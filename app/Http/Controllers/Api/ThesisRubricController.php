<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisRubricStoreRequest;
use App\Http\Requests\ThesisRubricUpdateRequest;
use App\Http\Resources\ThesisRubricCollection;
use App\Http\Resources\ThesisRubricResource;
use App\Models\ThesisRubric;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisRubricController extends Controller
{
    public function index(Request $request): ThesisRubricCollection
    {
        $thesisRubrics = ThesisRubric::all();

        return new ThesisRubricCollection($thesisRubrics);
    }

    public function store(ThesisRubricStoreRequest $request): ThesisRubricResource
    {
        $thesisRubric = ThesisRubric::create($request->validated());

        return new ThesisRubricResource($thesisRubric);
    }

    public function show(Request $request, ThesisRubric $thesisRubric): ThesisRubricResource
    {
        return new ThesisRubricResource($thesisRubric);
    }

    public function update(ThesisRubricUpdateRequest $request, ThesisRubric $thesisRubric): ThesisRubricResource
    {
        $thesisRubric->update($request->validated());

        return new ThesisRubricResource($thesisRubric);
    }

    public function destroy(Request $request, ThesisRubric $thesisRubric): Response
    {
        $thesisRubric->delete();

        return response()->noContent();
    }
}
