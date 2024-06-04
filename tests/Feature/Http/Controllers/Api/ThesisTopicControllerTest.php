<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ThesisTopic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisTopicController
 */
final class ThesisTopicControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisTopics = ThesisTopic::factory()->count(3)->create();

        $response = $this->get(route('thesis-topics.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisTopicController::class,
            'store',
            \App\Http\Requests\ThesisTopicStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('thesis-topics.store'), [
            'name' => $name,
        ]);

        $thesisTopics = ThesisTopic::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $thesisTopics);
        $thesisTopic = $thesisTopics->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisTopic = ThesisTopic::factory()->create();

        $response = $this->get(route('thesis-topics.show', $thesisTopic));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisTopicController::class,
            'update',
            \App\Http\Requests\ThesisTopicUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisTopic = ThesisTopic::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('thesis-topics.update', $thesisTopic), [
            'name' => $name,
        ]);

        $thesisTopic->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $thesisTopic->name);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisTopic = ThesisTopic::factory()->create();

        $response = $this->delete(route('thesis-topics.destroy', $thesisTopic));

        $response->assertNoContent();

        $this->assertModelMissing($thesisTopic);
    }
}
