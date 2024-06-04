<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassMeetingStoreRequest;
use App\Http\Requests\ClassMeetingUpdateRequest;
use App\Http\Resources\ClassMeetingCollection;
use App\Http\Resources\ClassMeetingResource;
use App\Models\ClassMeeting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassMeetingController extends Controller
{
    public function index(Request $request): ClassMeetingCollection
    {
        $classMeetings = ClassMeeting::all();

        return new ClassMeetingCollection($classMeetings);
    }

    public function store(ClassMeetingStoreRequest $request): ClassMeetingResource
    {
        $classMeeting = ClassMeeting::create($request->validated());

        return new ClassMeetingResource($classMeeting);
    }

    public function show(Request $request, ClassMeeting $classMeeting): ClassMeetingResource
    {
        return new ClassMeetingResource($classMeeting);
    }

    public function update(ClassMeetingUpdateRequest $request, ClassMeeting $classMeeting): ClassMeetingResource
    {
        $classMeeting->update($request->validated());

        return new ClassMeetingResource($classMeeting);
    }

    public function destroy(Request $request, ClassMeeting $classMeeting): Response
    {
        $classMeeting->delete();

        return response()->noContent();
    }
}
