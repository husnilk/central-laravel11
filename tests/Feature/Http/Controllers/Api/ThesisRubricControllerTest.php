<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ThesisRubric;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisRubricController
 */
final class ThesisRubricControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisRubrics = ThesisRubric::factory()->count(3)->create();

        $response = $this->get(route('thesis-rubrics.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisRubricController::class,
            'store',
            \App\Http\Requests\ThesisRubricStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $active = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('thesis-rubrics.store'), [
            'name' => $name,
            'active' => $active,
        ]);

        $thesisRubrics = ThesisRubric::query()
            ->where('name', $name)
            ->where('active', $active)
            ->get();
        $this->assertCount(1, $thesisRubrics);
        $thesisRubric = $thesisRubrics->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisRubric = ThesisRubric::factory()->create();

        $response = $this->get(route('thesis-rubrics.show', $thesisRubric));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisRubricController::class,
            'update',
            \App\Http\Requests\ThesisRubricUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisRubric = ThesisRubric::factory()->create();
        $name = $this->faker->name();
        $active = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('thesis-rubrics.update', $thesisRubric), [
            'name' => $name,
            'active' => $active,
        ]);

        $thesisRubric->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $thesisRubric->name);
        $this->assertEquals($active, $thesisRubric->active);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisRubric = ThesisRubric::factory()->create();

        $response = $this->delete(route('thesis-rubrics.destroy', $thesisRubric));

        $response->assertNoContent();

        $this->assertModelMissing($thesisRubric);
    }
}
