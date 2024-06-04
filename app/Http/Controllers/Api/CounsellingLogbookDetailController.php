<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounsellingLogbookDetailStoreRequest;
use App\Http\Requests\CounsellingLogbookDetailUpdateRequest;
use App\Http\Resources\CounsellingLogbookDetailCollection;
use App\Http\Resources\CounsellingLogbookDetailResource;
use App\Models\CounsellingLogbookDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CounsellingLogbookDetailController extends Controller
{
    public function index(Request $request): CounsellingLogbookDetailCollection
    {
        $counsellingLogbookDetails = CounsellingLogbookDetail::all();

        return new CounsellingLogbookDetailCollection($counsellingLogbookDetails);
    }

    public function store(CounsellingLogbookDetailStoreRequest $request): CounsellingLogbookDetailResource
    {
        $counsellingLogbookDetail = CounsellingLogbookDetail::create($request->validated());

        return new CounsellingLogbookDetailResource($counsellingLogbookDetail);
    }

    public function show(Request $request, CounsellingLogbookDetail $counsellingLogbookDetail): CounsellingLogbookDetailResource
    {
        return new CounsellingLogbookDetailResource($counsellingLogbookDetail);
    }

    public function update(CounsellingLogbookDetailUpdateRequest $request, CounsellingLogbookDetail $counsellingLogbookDetail): CounsellingLogbookDetailResource
    {
        $counsellingLogbookDetail->update($request->validated());

        return new CounsellingLogbookDetailResource($counsellingLogbookDetail);
    }

    public function destroy(Request $request, CounsellingLogbookDetail $counsellingLogbookDetail): Response
    {
        $counsellingLogbookDetail->delete();

        return response()->noContent();
    }
}
