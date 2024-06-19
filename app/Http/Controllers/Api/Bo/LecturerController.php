<?php

namespace App\Http\Controllers\Api\Bo;

use App\Http\Controllers\Controller;
use App\Http\Requests\LecturerStoreRequest;
use App\Http\Requests\LecturerUpdateRequest;
use App\Http\Resources\LecturerCollection;
use App\Http\Resources\LecturerResource;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LecturerController extends Controller
{
    public function index(Request $request): LecturerCollection
    {
        $lecturers = Lecturer::all();

        return new LecturerCollection($lecturers);
    }

    public function store(LecturerStoreRequest $request): LecturerResource
    {
        $lecturer = Lecturer::create($request->validated());

        return new LecturerResource($lecturer);
    }

    public function show(Request $request, Lecturer $lecturer): LecturerResource
    {
        return new LecturerResource($lecturer);
    }

    public function update(LecturerUpdateRequest $request, Lecturer $lecturer): LecturerResource
    {
        $lecturer->update($request->validated());

        return new LecturerResource($lecturer);
    }

    public function destroy(Request $request, Lecturer $lecturer): Response
    {
        $lecturer->delete();

        return response()->noContent();
    }
}
