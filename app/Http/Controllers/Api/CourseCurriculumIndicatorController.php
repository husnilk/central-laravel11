<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCurriculumIndicatorStoreRequest;
use App\Http\Requests\CourseCurriculumIndicatorUpdateRequest;
use App\Http\Resources\CourseCurriculumIndicatorCollection;
use App\Http\Resources\CourseCurriculumIndicatorResource;
use App\Models\CourseCurriculumIndicator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseCurriculumIndicatorController extends Controller
{
    public function index(Request $request): CourseCurriculumIndicatorCollection
    {
        $courseCurriculumIndicators = CourseCurriculumIndicator::all();

        return new CourseCurriculumIndicatorCollection($courseCurriculumIndicators);
    }

    public function store(CourseCurriculumIndicatorStoreRequest $request): CourseCurriculumIndicatorResource
    {
        $courseCurriculumIndicator = CourseCurriculumIndicator::create($request->validated());

        return new CourseCurriculumIndicatorResource($courseCurriculumIndicator);
    }

    public function show(Request $request, CourseCurriculumIndicator $courseCurriculumIndicator): CourseCurriculumIndicatorResource
    {
        return new CourseCurriculumIndicatorResource($courseCurriculumIndicator);
    }

    public function update(CourseCurriculumIndicatorUpdateRequest $request, CourseCurriculumIndicator $courseCurriculumIndicator): CourseCurriculumIndicatorResource
    {
        $courseCurriculumIndicator->update($request->validated());

        return new CourseCurriculumIndicatorResource($courseCurriculumIndicator);
    }

    public function destroy(Request $request, CourseCurriculumIndicator $courseCurriculumIndicator): Response
    {
        $courseCurriculumIndicator->delete();

        return response()->noContent();
    }
}
