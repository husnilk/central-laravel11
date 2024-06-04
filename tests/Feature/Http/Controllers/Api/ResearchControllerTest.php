<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Research;
use App\Models\ResearchSchema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ResearchController
 */
final class ResearchControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $research = Research::factory()->count(3)->create();

        $response = $this->get(route('research.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ResearchController::class,
            'store',
            \App\Http\Requests\ResearchStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = $this->faker->sentence(4);
        $research_schema = ResearchSchema::factory()->create();

        $response = $this->post(route('research.store'), [
            'title' => $title,
            'research_schema_id' => $research_schema->id,
        ]);

        $research = Research::query()
            ->where('title', $title)
            ->where('research_schema_id', $research_schema->id)
            ->get();
        $this->assertCount(1, $research);
        $research = $research->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $research = Research::factory()->create();

        $response = $this->get(route('research.show', $research));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ResearchController::class,
            'update',
            \App\Http\Requests\ResearchUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $research = Research::factory()->create();
        $title = $this->faker->sentence(4);
        $research_schema = ResearchSchema::factory()->create();

        $response = $this->put(route('research.update', $research), [
            'title' => $title,
            'research_schema_id' => $research_schema->id,
        ]);

        $research->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $research->title);
        $this->assertEquals($research_schema->id, $research->research_schema_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $research = Research::factory()->create();

        $response = $this->delete(route('research.destroy', $research));

        $response->assertNoContent();

        $this->assertModelMissing($research);
    }
}
