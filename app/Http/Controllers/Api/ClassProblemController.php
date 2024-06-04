<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassProblemStoreRequest;
use App\Http\Requests\ClassProblemUpdateRequest;
use App\Http\Resources\ClassProblemCollection;
use App\Http\Resources\ClassProblemResource;
use App\Models\ClassProblem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassProblemController extends Controller
{
    public function index(Request $request): ClassProblemCollection
    {
        $classProblems = ClassProblem::all();

        return new ClassProblemCollection($classProblems);
    }

    public function store(ClassProblemStoreRequest $request): ClassProblemResource
    {
        $classProblem = ClassProblem::create($request->validated());

        return new ClassProblemResource($classProblem);
    }

    public function show(Request $request, ClassProblem $classProblem): ClassProblemResource
    {
        return new ClassProblemResource($classProblem);
    }

    public function update(ClassProblemUpdateRequest $request, ClassProblem $classProblem): ClassProblemResource
    {
        $classProblem->update($request->validated());

        return new ClassProblemResource($classProblem);
    }

    public function destroy(Request $request, ClassProblem $classProblem): Response
    {
        $classProblem->delete();

        return response()->noContent();
    }
}
