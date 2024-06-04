<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounsellingLogbookStoreRequest;
use App\Http\Requests\CounsellingLogbookUpdateRequest;
use App\Http\Resources\CounsellingLogbookCollection;
use App\Http\Resources\CounsellingLogbookResource;
use App\Models\CounsellingLogbook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CounsellingLogbookController extends Controller
{
    public function index(Request $request): CounsellingLogbookCollection
    {
        $counsellingLogbooks = CounsellingLogbook::all();

        return new CounsellingLogbookCollection($counsellingLogbooks);
    }

    public function store(CounsellingLogbookStoreRequest $request): CounsellingLogbookResource
    {
        $counsellingLogbook = CounsellingLogbook::create($request->validated());

        return new CounsellingLogbookResource($counsellingLogbook);
    }

    public function show(Request $request, CounsellingLogbook $counsellingLogbook): CounsellingLogbookResource
    {
        return new CounsellingLogbookResource($counsellingLogbook);
    }

    public function update(CounsellingLogbookUpdateRequest $request, CounsellingLogbook $counsellingLogbook): CounsellingLogbookResource
    {
        $counsellingLogbook->update($request->validated());

        return new CounsellingLogbookResource($counsellingLogbook);
    }

    public function destroy(Request $request, CounsellingLogbook $counsellingLogbook): Response
    {
        $counsellingLogbook->delete();

        return response()->noContent();
    }
}
