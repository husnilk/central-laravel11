<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumPeoStoreRequest;
use App\Http\Requests\CurriculumPeoUpdateRequest;
use App\Http\Resources\CurriculumPeoCollection;
use App\Http\Resources\CurriculumPeoResource;
use App\Models\CurriculumPeo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurriculumPeoController extends Controller
{
    public function index(Request $request): CurriculumPeoCollection
    {
        $curriculumPeos = CurriculumPeo::all();

        return new CurriculumPeoCollection($curriculumPeos);
    }

    public function store(CurriculumPeoStoreRequest $request): CurriculumPeoResource
    {
        $curriculumPeo = CurriculumPeo::create($request->validated());

        return new CurriculumPeoResource($curriculumPeo);
    }

    public function show(Request $request, CurriculumPeo $curriculumPeo): CurriculumPeoResource
    {
        return new CurriculumPeoResource($curriculumPeo);
    }

    public function update(CurriculumPeoUpdateRequest $request, CurriculumPeo $curriculumPeo): CurriculumPeoResource
    {
        $curriculumPeo->update($request->validated());

        return new CurriculumPeoResource($curriculumPeo);
    }

    public function destroy(Request $request, CurriculumPeo $curriculumPeo): Response
    {
        $curriculumPeo->delete();

        return response()->noContent();
    }
}
