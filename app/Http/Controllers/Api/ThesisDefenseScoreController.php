<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisDefenseScoreStoreRequest;
use App\Http\Requests\ThesisDefenseScoreUpdateRequest;
use App\Http\Resources\ThesisDefenseScoreCollection;
use App\Http\Resources\ThesisDefenseScoreResource;
use App\Models\ThesisDefenseScore;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisDefenseScoreController extends Controller
{
    public function index(Request $request): ThesisDefenseScoreCollection
    {
        $thesisDefenseScores = ThesisDefenseScore::all();

        return new ThesisDefenseScoreCollection($thesisDefenseScores);
    }

    public function store(ThesisDefenseScoreStoreRequest $request): ThesisDefenseScoreResource
    {
        $thesisDefenseScore = ThesisDefenseScore::create($request->validated());

        return new ThesisDefenseScoreResource($thesisDefenseScore);
    }

    public function show(Request $request, ThesisDefenseScore $thesisDefenseScore): ThesisDefenseScoreResource
    {
        return new ThesisDefenseScoreResource($thesisDefenseScore);
    }

    public function update(ThesisDefenseScoreUpdateRequest $request, ThesisDefenseScore $thesisDefenseScore): ThesisDefenseScoreResource
    {
        $thesisDefenseScore->update($request->validated());

        return new ThesisDefenseScoreResource($thesisDefenseScore);
    }

    public function destroy(Request $request, ThesisDefenseScore $thesisDefenseScore): Response
    {
        $thesisDefenseScore->delete();

        return response()->noContent();
    }
}
