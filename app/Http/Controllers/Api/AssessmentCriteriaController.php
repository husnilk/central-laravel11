<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssessmentCriteriaStoreRequest;
use App\Http\Requests\AssessmentCriteriaUpdateRequest;
use App\Http\Resources\AssessmentCriterionCollection;
use App\Http\Resources\AssessmentCriterionResource;
use App\Models\AssessmentCriteria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssessmentCriteriaController extends Controller
{
    public function index(Request $request): AssessmentCriterionCollection
    {
        $assessmentCriteria = AssessmentCriterion::all();

        return new AssessmentCriterionCollection($assessmentCriteria);
    }

    public function store(AssessmentCriteriaStoreRequest $request): AssessmentCriterionResource
    {
        $assessmentCriterion = AssessmentCriterion::create($request->validated());

        return new AssessmentCriterionResource($assessmentCriterion);
    }

    public function show(Request $request, AssessmentCriterion $assessmentCriterion): AssessmentCriterionResource
    {
        return new AssessmentCriterionResource($assessmentCriterion);
    }

    public function update(AssessmentCriteriaUpdateRequest $request, AssessmentCriterion $assessmentCriterion): AssessmentCriterionResource
    {
        $assessmentCriterion->update($request->validated());

        return new AssessmentCriterionResource($assessmentCriterion);
    }

    public function destroy(Request $request, AssessmentCriterion $assessmentCriterion): Response
    {
        $assessmentCriterion->delete();

        return response()->noContent();
    }
}
