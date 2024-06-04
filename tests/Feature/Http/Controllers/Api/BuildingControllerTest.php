<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\BuildingController
 */
final class BuildingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $buildings = Building::factory()->count(3)->create();

        $response = $this->get(route('buildings.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\BuildingController::class,
            'store',
            \App\Http\Requests\BuildingStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('buildings.store'), [
            'name' => $name,
        ]);

        $buildings = Building::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $buildings);
        $building = $buildings->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $building = Building::factory()->create();

        $response = $this->get(route('buildings.show', $building));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\BuildingController::class,
            'update',
            \App\Http\Requests\BuildingUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $building = Building::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('buildings.update', $building), [
            'name' => $name,
        ]);

        $building->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $building->name);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $building = Building::factory()->create();

        $response = $this->delete(route('buildings.destroy', $building));

        $response->assertNoContent();

        $this->assertModelMissing($building);
    }
}
