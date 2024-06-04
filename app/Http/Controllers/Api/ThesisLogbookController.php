<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisLogbookStoreRequest;
use App\Http\Requests\ThesisLogbookUpdateRequest;
use App\Http\Resources\ThesisLogbookCollection;
use App\Http\Resources\ThesisLogbookResource;
use App\Models\ThesisLogbook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisLogbookController extends Controller
{
    public function index(Request $request): ThesisLogbookCollection
    {
        $thesisLogbooks = ThesisLogbook::all();

        return new ThesisLogbookCollection($thesisLogbooks);
    }

    public function store(ThesisLogbookStoreRequest $request): ThesisLogbookResource
    {
        $thesisLogbook = ThesisLogbook::create($request->validated());

        return new ThesisLogbookResource($thesisLogbook);
    }

    public function show(Request $request, ThesisLogbook $thesisLogbook): ThesisLogbookResource
    {
        return new ThesisLogbookResource($thesisLogbook);
    }

    public function update(ThesisLogbookUpdateRequest $request, ThesisLogbook $thesisLogbook): ThesisLogbookResource
    {
        $thesisLogbook->update($request->validated());

        return new ThesisLogbookResource($thesisLogbook);
    }

    public function destroy(Request $request, ThesisLogbook $thesisLogbook): Response
    {
        $thesisLogbook->delete();

        return response()->noContent();
    }
}
