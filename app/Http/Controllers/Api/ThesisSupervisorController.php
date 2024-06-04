<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThesisSupervisorStoreRequest;
use App\Http\Requests\ThesisSupervisorUpdateRequest;
use App\Http\Resources\ThesisSupervisorCollection;
use App\Http\Resources\ThesisSupervisorResource;
use App\Models\ThesisSupervisor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThesisSupervisorController extends Controller
{
    public function index(Request $request): ThesisSupervisorCollection
    {
        $thesisSupervisors = ThesisSupervisor::all();

        return new ThesisSupervisorCollection($thesisSupervisors);
    }

    public function store(ThesisSupervisorStoreRequest $request): ThesisSupervisorResource
    {
        $thesisSupervisor = ThesisSupervisor::create($request->validated());

        return new ThesisSupervisorResource($thesisSupervisor);
    }

    public function show(Request $request, ThesisSupervisor $thesisSupervisor): ThesisSupervisorResource
    {
        return new ThesisSupervisorResource($thesisSupervisor);
    }

    public function update(ThesisSupervisorUpdateRequest $request, ThesisSupervisor $thesisSupervisor): ThesisSupervisorResource
    {
        $thesisSupervisor->update($request->validated());

        return new ThesisSupervisorResource($thesisSupervisor);
    }

    public function destroy(Request $request, ThesisSupervisor $thesisSupervisor): Response
    {
        $thesisSupervisor->delete();

        return response()->noContent();
    }
}
