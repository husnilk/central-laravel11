<?php

namespace App\Http\Controllers\Api\Bo;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Http\Resources\StaffCollection;
use App\Http\Resources\StaffResource;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffController extends Controller
{
    public function index(Request $request): StaffCollection
    {
        $staff = Staff::all();

        return new StaffCollection($staff);
    }

    public function store(StaffStoreRequest $request): StaffResource
    {
        $staff = Staff::create($request->validated());

        return new StaffResource($staff);
    }

    public function show(Request $request, Staff $staff): StaffResource
    {
        return new StaffResource($staff);
    }

    public function update(StaffUpdateRequest $request, Staff $staff): StaffResource
    {
        $staff->update($request->validated());

        return new StaffResource($staff);
    }

    public function destroy(Request $request, Staff $staff): Response
    {
        $staff->delete();

        return response()->noContent();
    }
}
