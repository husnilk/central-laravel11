<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CommunityServiceSchema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CommunityServiceSchemaController
 */
final class CommunityServiceSchemaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $communityServiceSchemas = CommunityServiceSchema::factory()->count(3)->create();

        $response = $this->get(route('community-service-schemas.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CommunityServiceSchemaController::class,
            'store',
            \App\Http\Requests\CommunityServiceSchemaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('community-service-schemas.store'), [
            'name' => $name,
        ]);

        $communityServiceSchemas = CommunityServiceSchema::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $communityServiceSchemas);
        $communityServiceSchema = $communityServiceSchemas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $communityServiceSchema = CommunityServiceSchema::factory()->create();

        $response = $this->get(route('community-service-schemas.show', $communityServiceSchema));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CommunityServiceSchemaController::class,
            'update',
            \App\Http\Requests\CommunityServiceSchemaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $communityServiceSchema = CommunityServiceSchema::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('community-service-schemas.update', $communityServiceSchema), [
            'name' => $name,
        ]);

        $communityServiceSchema->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $communityServiceSchema->name);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $communityServiceSchema = CommunityServiceSchema::factory()->create();

        $response = $this->delete(route('community-service-schemas.destroy', $communityServiceSchema));

        $response->assertNoContent();

        $this->assertModelMissing($communityServiceSchema);
    }
}
