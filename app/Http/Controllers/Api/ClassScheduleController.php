<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassScheduleStoreRequest;
use App\Http\Requests\ClassScheduleUpdateRequest;
use App\Http\Resources\ClassScheduleCollection;
use App\Http\Resources\ClassScheduleResource;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassScheduleController extends Controller
{
    public function index(Request $request): ClassScheduleCollection
    {
        $classSchedules = ClassSchedule::all();

        return new ClassScheduleCollection($classSchedules);
    }

    public function store(ClassScheduleStoreRequest $request): ClassScheduleResource
    {
        $classSchedule = ClassSchedule::create($request->validated());

        return new ClassScheduleResource($classSchedule);
    }

    public function show(Request $request, ClassSchedule $classSchedule): ClassScheduleResource
    {
        return new ClassScheduleResource($classSchedule);
    }

    public function update(ClassScheduleUpdateRequest $request, ClassSchedule $classSchedule): ClassScheduleResource
    {
        $classSchedule->update($request->validated());

        return new ClassScheduleResource($classSchedule);
    }

    public function destroy(Request $request, ClassSchedule $classSchedule): Response
    {
        $classSchedule->delete();

        return response()->noContent();
    }
}
