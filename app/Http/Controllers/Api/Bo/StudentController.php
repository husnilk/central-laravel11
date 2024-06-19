<?php

namespace App\Http\Controllers\Api\Bo;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
    public function index(Request $request): StudentCollection
    {
        $students = Student::all();

        return new StudentCollection($students);
    }

    public function store(StudentStoreRequest $request): StudentResource
    {
        $student = Student::create($request->validated());

        return new StudentResource($student);
    }

    public function show(Request $request, Student $student): StudentResource
    {
        return new StudentResource($student);
    }

    public function update(StudentUpdateRequest $request, Student $student): StudentResource
    {
        $student->update($request->validated());

        return new StudentResource($student);
    }

    public function destroy(Request $request, Student $student): Response
    {
        $student->delete();

        return response()->noContent();
    }
}
