<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternshipCompanyStoreRequest;
use App\Http\Requests\InternshipCompanyUpdateRequest;
use App\Http\Resources\InternshipCompanyCollection;
use App\Http\Resources\InternshipCompanyResource;
use App\Models\InternshipCompany;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InternshipCompanyController extends Controller
{
    public function index(Request $request): InternshipCompanyCollection
    {
        $internshipCompanies = InternshipCompany::all();

        return new InternshipCompanyCollection($internshipCompanies);
    }

    public function store(InternshipCompanyStoreRequest $request): InternshipCompanyResource
    {
        $internshipCompany = InternshipCompany::create($request->validated());

        return new InternshipCompanyResource($internshipCompany);
    }

    public function show(Request $request, InternshipCompany $internshipCompany): InternshipCompanyResource
    {
        return new InternshipCompanyResource($internshipCompany);
    }

    public function update(InternshipCompanyUpdateRequest $request, InternshipCompany $internshipCompany): InternshipCompanyResource
    {
        $internshipCompany->update($request->validated());

        return new InternshipCompanyResource($internshipCompany);
    }

    public function destroy(Request $request, InternshipCompany $internshipCompany): Response
    {
        $internshipCompany->delete();

        return response()->noContent();
    }
}
