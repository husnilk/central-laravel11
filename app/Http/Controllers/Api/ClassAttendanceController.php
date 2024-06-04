<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassAttendanceStoreRequest;
use App\Http\Requests\ClassAttendanceUpdateRequest;
use App\Http\Resources\ClassAttendanceCollection;
use App\Http\Resources\ClassAttendanceResource;
use App\Models\ClassAttendance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassAttendanceController extends Controller
{
    public function index(Request $request): ClassAttendanceCollection
    {
        $classAttendances = ClassAttendance::all();

        return new ClassAttendanceCollection($classAttendances);
    }

    public function store(ClassAttendanceStoreRequest $request): ClassAttendanceResource
    {
        $classAttendance = ClassAttendance::create($request->validated());

        return new ClassAttendanceResource($classAttendance);
    }

    public function show(Request $request, ClassAttendance $classAttendance): ClassAttendanceResource
    {
        return new ClassAttendanceResource($classAttendance);
    }

    public function update(ClassAttendanceUpdateRequest $request, ClassAttendance $classAttendance): ClassAttendanceResource
    {
        $classAttendance->update($request->validated());

        return new ClassAttendanceResource($classAttendance);
    }

    public function destroy(Request $request, ClassAttendance $classAttendance): Response
    {
        $classAttendance->delete();

        return response()->noContent();
    }
}
