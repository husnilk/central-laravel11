<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisDefenseExaminerStoreRequest;
use App\Http\Requests\ThesisDefenseExaminerUpdateRequest;
use App\Http\Resources\ThesisDefenseExaminerCollection;
use App\Http\Resources\ThesisDefenseExaminerResource;
use App\Models\ThesisDefenseExaminer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisDefenseExaminerController extends Controller
{
    public function index(Request $request): ThesisDefenseExaminerCollection
    {
        $thesisDefenseExaminers = ThesisDefenseExaminer::all();

        return new ThesisDefenseExaminerCollection($thesisDefenseExaminers);
    }

    public function store(ThesisDefenseExaminerStoreRequest $request): ThesisDefenseExaminerResource
    {
        $thesisDefenseExaminer = ThesisDefenseExaminer::create($request->validated());

        return new ThesisDefenseExaminerResource($thesisDefenseExaminer);
    }

    public function show(Request $request, ThesisDefenseExaminer $thesisDefenseExaminer): ThesisDefenseExaminerResource
    {
        return new ThesisDefenseExaminerResource($thesisDefenseExaminer);
    }

    public function update(ThesisDefenseExaminerUpdateRequest $request, ThesisDefenseExaminer $thesisDefenseExaminer): ThesisDefenseExaminerResource
    {
        $thesisDefenseExaminer->update($request->validated());

        return new ThesisDefenseExaminerResource($thesisDefenseExaminer);
    }

    public function destroy(Request $request, ThesisDefenseExaminer $thesisDefenseExaminer): Response
    {
        $thesisDefenseExaminer->delete();

        return response()->noContent();
    }
}
