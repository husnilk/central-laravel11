<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\PublisherController
 */
final class PublisherControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $publishers = Publisher::factory()->count(3)->create();

        $response = $this->get(route('publishers.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PublisherController::class,
            'store',
            \App\Http\Requests\PublisherStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $international = $this->faker->numberBetween(-10000, 10000);
        $indexed = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('publishers.store'), [
            'name' => $name,
            'type' => $type,
            'international' => $international,
            'indexed' => $indexed,
        ]);

        $publishers = Publisher::query()
            ->where('name', $name)
            ->where('type', $type)
            ->where('international', $international)
            ->where('indexed', $indexed)
            ->get();
        $this->assertCount(1, $publishers);
        $publisher = $publishers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $publisher = Publisher::factory()->create();

        $response = $this->get(route('publishers.show', $publisher));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PublisherController::class,
            'update',
            \App\Http\Requests\PublisherUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $publisher = Publisher::factory()->create();
        $name = $this->faker->name();
        $type = $this->faker->randomElement(/** enum_attributes **/);
        $international = $this->faker->numberBetween(-10000, 10000);
        $indexed = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('publishers.update', $publisher), [
            'name' => $name,
            'type' => $type,
            'international' => $international,
            'indexed' => $indexed,
        ]);

        $publisher->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $publisher->name);
        $this->assertEquals($type, $publisher->type);
        $this->assertEquals($international, $publisher->international);
        $this->assertEquals($indexed, $publisher->indexed);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $publisher = Publisher::factory()->create();

        $response = $this->delete(route('publishers.destroy', $publisher));

        $response->assertNoContent();

        $this->assertModelMissing($publisher);
    }
}
