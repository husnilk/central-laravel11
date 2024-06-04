<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    public function index(Request $request): CourseCollection
    {
        $courses = Course::all();

        return new CourseCollection($courses);
    }

    public function store(CourseStoreRequest $request): CourseResource
    {
        $course = Course::create($request->validated());

        return new CourseResource($course);
    }

    public function show(Request $request, Course $course): CourseResource
    {
        return new CourseResource($course);
    }

    public function update(CourseUpdateRequest $request, Course $course): CourseResource
    {
        $course->update($request->validated());

        return new CourseResource($course);
    }

    public function destroy(Request $request, Course $course): Response
    {
        $course->delete();

        return response()->noContent();
    }
}
