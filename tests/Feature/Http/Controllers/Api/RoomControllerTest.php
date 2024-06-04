<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Building;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\RoomController
 */
final class RoomControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $rooms = Room::factory()->count(3)->create();

        $response = $this->get(route('rooms.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\RoomController::class,
            'store',
            \App\Http\Requests\RoomStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $building = Building::factory()->create();
        $name = $this->faker->name();
        $availability = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('rooms.store'), [
            'building_id' => $building->id,
            'name' => $name,
            'availability' => $availability,
        ]);

        $rooms = Room::query()
            ->where('building_id', $building->id)
            ->where('name', $name)
            ->where('availability', $availability)
            ->get();
        $this->assertCount(1, $rooms);
        $room = $rooms->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $room = Room::factory()->create();

        $response = $this->get(route('rooms.show', $room));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\RoomController::class,
            'update',
            \App\Http\Requests\RoomUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $room = Room::factory()->create();
        $building = Building::factory()->create();
        $name = $this->faker->name();
        $availability = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('rooms.update', $room), [
            'building_id' => $building->id,
            'name' => $name,
            'availability' => $availability,
        ]);

        $room->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($building->id, $room->building_id);
        $this->assertEquals($name, $room->name);
        $this->assertEquals($availability, $room->availability);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $room = Room::factory()->create();

        $response = $this->delete(route('rooms.destroy', $room));

        $response->assertNoContent();

        $this->assertModelMissing($room);
    }
}
