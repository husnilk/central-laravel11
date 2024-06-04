<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumStoreRequest;
use App\Http\Requests\CurriculumUpdateRequest;
use App\Http\Resources\CurriculumCollection;
use App\Http\Resources\CurriculumResource;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurriculumController extends Controller
{
    public function index(Request $request): CurriculumCollection
    {
        $curricula = Curriculum::all();

        return new CurriculumCollection($curricula);
    }

    public function store(CurriculumStoreRequest $request): CurriculumResource
    {
        $curriculum = Curriculum::create($request->validated());

        return new CurriculumResource($curriculum);
    }

    public function show(Request $request, Curriculum $curriculum): CurriculumResource
    {
        return new CurriculumResource($curriculum);
    }

    public function update(CurriculumUpdateRequest $request, Curriculum $curriculum): CurriculumResource
    {
        $curriculum->update($request->validated());

        return new CurriculumResource($curriculum);
    }

    public function destroy(Request $request, Curriculum $curriculum): Response
    {
        $curriculum->delete();

        return response()->noContent();
    }
}
