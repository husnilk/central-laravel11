<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssessmentDetailStoreRequest;
use App\Http\Requests\AssessmentDetailUpdateRequest;
use App\Http\Resources\AssessmentDetailCollection;
use App\Http\Resources\AssessmentDetailResource;
use App\Models\AssessmentDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssessmentDetailController extends Controller
{
    public function index(Request $request): AssessmentDetailCollection
    {
        $assessmentDetails = AssessmentDetail::all();

        return new AssessmentDetailCollection($assessmentDetails);
    }

    public function store(AssessmentDetailStoreRequest $request): AssessmentDetailResource
    {
        $assessmentDetail = AssessmentDetail::create($request->validated());

        return new AssessmentDetailResource($assessmentDetail);
    }

    public function show(Request $request, AssessmentDetail $assessmentDetail): AssessmentDetailResource
    {
        return new AssessmentDetailResource($assessmentDetail);
    }

    public function update(AssessmentDetailUpdateRequest $request, AssessmentDetail $assessmentDetail): AssessmentDetailResource
    {
        $assessmentDetail->update($request->validated());

        return new AssessmentDetailResource($assessmentDetail);
    }

    public function destroy(Request $request, AssessmentDetail $assessmentDetail): Response
    {
        $assessmentDetail->delete();

        return response()->noContent();
    }
}
