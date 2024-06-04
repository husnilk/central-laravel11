<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseEnrollmentDetailStoreRequest;
use App\Http\Requests\CourseEnrollmentDetailUpdateRequest;
use App\Http\Resources\CourseEnrollmentDetailCollection;
use App\Http\Resources\CourseEnrollmentDetailResource;
use App\Models\CourseEnrollmentDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseEnrollmentDetailController extends Controller
{
    public function index(Request $request): CourseEnrollmentDetailCollection
    {
        $courseEnrollmentDetails = CourseEnrollmentDetail::all();

        return new CourseEnrollmentDetailCollection($courseEnrollmentDetails);
    }

    public function store(CourseEnrollmentDetailStoreRequest $request): CourseEnrollmentDetailResource
    {
        $courseEnrollmentDetail = CourseEnrollmentDetail::create($request->validated());

        return new CourseEnrollmentDetailResource($courseEnrollmentDetail);
    }

    public function show(Request $request, CourseEnrollmentDetail $courseEnrollmentDetail): CourseEnrollmentDetailResource
    {
        return new CourseEnrollmentDetailResource($courseEnrollmentDetail);
    }

    public function update(CourseEnrollmentDetailUpdateRequest $request, CourseEnrollmentDetail $courseEnrollmentDetail): CourseEnrollmentDetailResource
    {
        $courseEnrollmentDetail->update($request->validated());

        return new CourseEnrollmentDetailResource($courseEnrollmentDetail);
    }

    public function destroy(Request $request, CourseEnrollmentDetail $courseEnrollmentDetail): Response
    {
        $courseEnrollmentDetail->delete();

        return response()->noContent();
    }
}
