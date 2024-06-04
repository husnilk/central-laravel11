<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseEnrollmentStoreRequest;
use App\Http\Requests\CourseEnrollmentUpdateRequest;
use App\Http\Resources\CourseEnrollmentCollection;
use App\Http\Resources\CourseEnrollmentResource;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseEnrollmentController extends Controller
{
    public function index(Request $request): CourseEnrollmentCollection
    {
        $courseEnrollments = CourseEnrollment::all();

        return new CourseEnrollmentCollection($courseEnrollments);
    }

    public function store(CourseEnrollmentStoreRequest $request): CourseEnrollmentResource
    {
        $courseEnrollment = CourseEnrollment::create($request->validated());

        return new CourseEnrollmentResource($courseEnrollment);
    }

    public function show(Request $request, CourseEnrollment $courseEnrollment): CourseEnrollmentResource
    {
        return new CourseEnrollmentResource($courseEnrollment);
    }

    public function update(CourseEnrollmentUpdateRequest $request, CourseEnrollment $courseEnrollment): CourseEnrollmentResource
    {
        $courseEnrollment->update($request->validated());

        return new CourseEnrollmentResource($courseEnrollment);
    }

    public function destroy(Request $request, CourseEnrollment $courseEnrollment): Response
    {
        $courseEnrollment->delete();

        return response()->noContent();
    }
}
