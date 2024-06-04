<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoursePlanLoStoreRequest;
use App\Http\Requests\CoursePlanLoUpdateRequest;
use App\Http\Resources\CoursePlanLoCollection;
use App\Http\Resources\CoursePlanLoResource;
use App\Models\CoursePlanLo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CoursePlanLoController extends Controller
{
    public function index(Request $request): CoursePlanLoCollection
    {
        $coursePlanLos = CoursePlanLo::all();

        return new CoursePlanLoCollection($coursePlanLos);
    }

    public function store(CoursePlanLoStoreRequest $request): CoursePlanLoResource
    {
        $coursePlanLo = CoursePlanLo::create($request->validated());

        return new CoursePlanLoResource($coursePlanLo);
    }

    public function show(Request $request, CoursePlanLo $coursePlanLo): CoursePlanLoResource
    {
        return new CoursePlanLoResource($coursePlanLo);
    }

    public function update(CoursePlanLoUpdateRequest $request, CoursePlanLo $coursePlanLo): CoursePlanLoResource
    {
        $coursePlanLo->update($request->validated());

        return new CoursePlanLoResource($coursePlanLo);
    }

    public function destroy(Request $request, CoursePlanLo $coursePlanLo): Response
    {
        $coursePlanLo->delete();

        return response()->noContent();
    }
}
