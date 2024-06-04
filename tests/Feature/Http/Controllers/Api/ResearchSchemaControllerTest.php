<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ResearchSchema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ResearchSchemaController
 */
final class ResearchSchemaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $researchSchemas = ResearchSchema::factory()->count(3)->create();

        $response = $this->get(route('research-schemas.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ResearchSchemaController::class,
            'store',
            \App\Http\Requests\ResearchSchemaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('research-schemas.store'), [
            'name' => $name,
        ]);

        $researchSchemas = ResearchSchema::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $researchSchemas);
        $researchSchema = $researchSchemas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $researchSchema = ResearchSchema::factory()->create();

        $response = $this->get(route('research-schemas.show', $researchSchema));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ResearchSchemaController::class,
            'update',
            \App\Http\Requests\ResearchSchemaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $researchSchema = ResearchSchema::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('research-schemas.update', $researchSchema), [
            'name' => $name,
        ]);

        $researchSchema->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $researchSchema->name);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $researchSchema = ResearchSchema::factory()->create();

        $response = $this->delete(route('research-schemas.destroy', $researchSchema));

        $response->assertNoContent();

        $this->assertModelMissing($researchSchema);
    }
}
