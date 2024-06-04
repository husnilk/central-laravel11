<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassCourseStoreRequest;
use App\Http\Requests\ClassCourseUpdateRequest;
use App\Http\Resources\ClassCourseCollection;
use App\Http\Resources\ClassCourseResource;
use App\Models\ClassCourse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassCourseController extends Controller
{
    public function index(Request $request): ClassCourseCollection
    {
        $classCourses = ClassCourse::all();

        return new ClassCourseCollection($classCourses);
    }

    public function store(ClassCourseStoreRequest $request): ClassCourseResource
    {
        $classCourse = ClassCourse::create($request->validated());

        return new ClassCourseResource($classCourse);
    }

    public function show(Request $request, ClassCourse $classCourse): ClassCourseResource
    {
        return new ClassCourseResource($classCourse);
    }

    public function update(ClassCourseUpdateRequest $request, ClassCourse $classCourse): ClassCourseResource
    {
        $classCourse->update($request->validated());

        return new ClassCourseResource($classCourse);
    }

    public function destroy(Request $request, ClassCourse $classCourse): Response
    {
        $classCourse->delete();

        return response()->noContent();
    }
}
