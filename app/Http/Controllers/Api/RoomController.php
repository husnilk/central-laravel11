<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomController extends Controller
{
    public function index(Request $request): RoomCollection
    {
        $rooms = Room::all();

        return new RoomCollection($rooms);
    }

    public function store(RoomStoreRequest $request): RoomResource
    {
        $room = Room::create($request->validated());

        return new RoomResource($room);
    }

    public function show(Request $request, Room $room): RoomResource
    {
        return new RoomResource($room);
    }

    public function update(RoomUpdateRequest $request, Room $room): RoomResource
    {
        $room->update($request->validated());

        return new RoomResource($room);
    }

    public function destroy(Request $request, Room $room): Response
    {
        $room->delete();

        return response()->noContent();
    }
}
