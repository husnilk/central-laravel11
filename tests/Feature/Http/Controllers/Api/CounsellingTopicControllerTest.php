<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CounsellingTopic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CounsellingTopicController
 */
final class CounsellingTopicControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $counsellingTopics = CounsellingTopic::factory()->count(3)->create();

        $response = $this->get(route('counselling-topics.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CounsellingTopicController::class,
            'store',
            \App\Http\Requests\CounsellingTopicStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('counselling-topics.store'), [
            'name' => $name,
        ]);

        $counsellingTopics = CounsellingTopic::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $counsellingTopics);
        $counsellingTopic = $counsellingTopics->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $counsellingTopic = CounsellingTopic::factory()->create();

        $response = $this->get(route('counselling-topics.show', $counsellingTopic));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CounsellingTopicController::class,
            'update',
            \App\Http\Requests\CounsellingTopicUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $counsellingTopic = CounsellingTopic::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('counselling-topics.update', $counsellingTopic), [
            'name' => $name,
        ]);

        $counsellingTopic->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $counsellingTopic->name);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $counsellingTopic = CounsellingTopic::factory()->create();

        $response = $this->delete(route('counselling-topics.destroy', $counsellingTopic));

        $response->assertNoContent();

        $this->assertModelMissing($counsellingTopic);
    }
}
