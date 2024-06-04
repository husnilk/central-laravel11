<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Publication;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\PublicationController
 */
final class PublicationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $publications = Publication::factory()->count(3)->create();

        $response = $this->get(route('publications.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PublicationController::class,
            'store',
            \App\Http\Requests\PublicationStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = $this->faker->sentence(4);
        $publisher = Publisher::factory()->create();
        $published_at = Carbon::parse($this->faker->date());

        $response = $this->post(route('publications.store'), [
            'title' => $title,
            'publisher_id' => $publisher->id,
            'published_at' => $published_at->toDateString(),
        ]);

        $publications = Publication::query()
            ->where('title', $title)
            ->where('publisher_id', $publisher->id)
            ->where('published_at', $published_at)
            ->get();
        $this->assertCount(1, $publications);
        $publication = $publications->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $publication = Publication::factory()->create();

        $response = $this->get(route('publications.show', $publication));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PublicationController::class,
            'update',
            \App\Http\Requests\PublicationUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $publication = Publication::factory()->create();
        $title = $this->faker->sentence(4);
        $publisher = Publisher::factory()->create();
        $published_at = Carbon::parse($this->faker->date());

        $response = $this->put(route('publications.update', $publication), [
            'title' => $title,
            'publisher_id' => $publisher->id,
            'published_at' => $published_at->toDateString(),
        ]);

        $publication->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $publication->title);
        $this->assertEquals($publisher->id, $publication->publisher_id);
        $this->assertEquals($published_at, $publication->published_at);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $publication = Publication::factory()->create();

        $response = $this->delete(route('publications.destroy', $publication));

        $response->assertNoContent();

        $this->assertModelMissing($publication);
    }
}
