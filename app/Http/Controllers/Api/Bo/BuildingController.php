<?php

namespace App\Http\Controllers\Api\Bo;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuildingStoreRequest;
use App\Http\Requests\BuildingUpdateRequest;
use App\Http\Resources\BuildingCollection;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BuildingController extends Controller
{
    public function index(Request $request): BuildingCollection
    {
        $buildings = Building::all();

        return new BuildingCollection($buildings);
    }

    public function store(BuildingStoreRequest $request): BuildingResource
    {
        $building = Building::create($request->validated());

        return new BuildingResource($building);
    }

    public function show(Request $request, Building $building): BuildingResource
    {
        return new BuildingResource($building);
    }

    public function update(BuildingUpdateRequest $request, Building $building): BuildingResource
    {
        $building->update($request->validated());

        return new BuildingResource($building);
    }

    public function destroy(Request $request, Building $building): Response
    {
        $building->delete();

        return response()->noContent();
    }
}
