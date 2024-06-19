<?php

namespace App\Http\Controllers\Api\Bo;

use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyStoreRequest;
use App\Http\Requests\FacultyUpdateRequest;
use App\Http\Resources\FacultyCollection;
use App\Http\Resources\FacultyResource;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FacultyController extends Controller
{
    public function index(Request $request): FacultyCollection
    {
        $faculties = Faculty::all();

        return new FacultyCollection($faculties);
    }

    public function store(FacultyStoreRequest $request): FacultyResource
    {
        $faculty = Faculty::create($request->validated());

        return new FacultyResource($faculty);
    }

    public function show(Request $request, Faculty $faculty): FacultyResource
    {
        return new FacultyResource($faculty);
    }

    public function update(FacultyUpdateRequest $request, Faculty $faculty): FacultyResource
    {
        $faculty->update($request->validated());

        return new FacultyResource($faculty);
    }

    public function destroy(Request $request, Faculty $faculty): Response
    {
        $faculty->delete();

        return response()->noContent();
    }
}
