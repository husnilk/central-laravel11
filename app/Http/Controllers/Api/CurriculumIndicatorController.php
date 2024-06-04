<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumIndicatorStoreRequest;
use App\Http\Requests\CurriculumIndicatorUpdateRequest;
use App\Http\Resources\CurriculumIndicatorCollection;
use App\Http\Resources\CurriculumIndicatorResource;
use App\Models\CurriculumIndicator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurriculumIndicatorController extends Controller
{
    public function index(Request $request): CurriculumIndicatorCollection
    {
        $curriculumIndicators = CurriculumIndicator::all();

        return new CurriculumIndicatorCollection($curriculumIndicators);
    }

    public function store(CurriculumIndicatorStoreRequest $request): CurriculumIndicatorResource
    {
        $curriculumIndicator = CurriculumIndicator::create($request->validated());

        return new CurriculumIndicatorResource($curriculumIndicator);
    }

    public function show(Request $request, CurriculumIndicator $curriculumIndicator): CurriculumIndicatorResource
    {
        return new CurriculumIndicatorResource($curriculumIndicator);
    }

    public function update(CurriculumIndicatorUpdateRequest $request, CurriculumIndicator $curriculumIndicator): CurriculumIndicatorResource
    {
        $curriculumIndicator->update($request->validated());

        return new CurriculumIndicatorResource($curriculumIndicator);
    }

    public function destroy(Request $request, CurriculumIndicator $curriculumIndicator): Response
    {
        $curriculumIndicator->delete();

        return response()->noContent();
    }
}
