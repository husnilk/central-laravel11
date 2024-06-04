<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Publication;
use App\Models\PublicationAuthor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\PublicationAuthorController
 */
final class PublicationAuthorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $publicationAuthors = PublicationAuthor::factory()->count(3)->create();

        $response = $this->get(route('publication-authors.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PublicationAuthorController::class,
            'store',
            \App\Http\Requests\PublicationAuthorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $publication = Publication::factory()->create();
        $user = User::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);
        $corresponding = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('publication-authors.store'), [
            'publication_id' => $publication->id,
            'user_id' => $user->id,
            'position' => $position,
            'corresponding' => $corresponding,
        ]);

        $publicationAuthors = PublicationAuthor::query()
            ->where('publication_id', $publication->id)
            ->where('user_id', $user->id)
            ->where('position', $position)
            ->where('corresponding', $corresponding)
            ->get();
        $this->assertCount(1, $publicationAuthors);
        $publicationAuthor = $publicationAuthors->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $publicationAuthor = PublicationAuthor::factory()->create();

        $response = $this->get(route('publication-authors.show', $publicationAuthor));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PublicationAuthorController::class,
            'update',
            \App\Http\Requests\PublicationAuthorUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $publicationAuthor = PublicationAuthor::factory()->create();
        $publication = Publication::factory()->create();
        $user = User::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);
        $corresponding = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('publication-authors.update', $publicationAuthor), [
            'publication_id' => $publication->id,
            'user_id' => $user->id,
            'position' => $position,
            'corresponding' => $corresponding,
        ]);

        $publicationAuthor->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($publication->id, $publicationAuthor->publication_id);
        $this->assertEquals($user->id, $publicationAuthor->user_id);
        $this->assertEquals($position, $publicationAuthor->position);
        $this->assertEquals($corresponding, $publicationAuthor->corresponding);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $publicationAuthor = PublicationAuthor::factory()->create();

        $response = $this->delete(route('publication-authors.destroy', $publicationAuthor));

        $response->assertNoContent();

        $this->assertModelMissing($publicationAuthor);
    }
}
