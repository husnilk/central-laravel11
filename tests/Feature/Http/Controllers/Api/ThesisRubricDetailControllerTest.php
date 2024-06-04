<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ThesisRubric;
use App\Models\ThesisRubricDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisRubricDetailController
 */
final class ThesisRubricDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisRubricDetails = ThesisRubricDetail::factory()->count(3)->create();

        $response = $this->get(route('thesis-rubric-details.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisRubricDetailController::class,
            'store',
            \App\Http\Requests\ThesisRubricDetailStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis_rubric = ThesisRubric::factory()->create();
        $description = $this->faker->text();
        $percentage = $this->faker->randomFloat(/** float_attributes **/);

        $response = $this->post(route('thesis-rubric-details.store'), [
            'thesis_rubric_id' => $thesis_rubric->id,
            'description' => $description,
            'percentage' => $percentage,
        ]);

        $thesisRubricDetails = ThesisRubricDetail::query()
            ->where('thesis_rubric_id', $thesis_rubric->id)
            ->where('description', $description)
            ->where('percentage', $percentage)
            ->get();
        $this->assertCount(1, $thesisRubricDetails);
        $thesisRubricDetail = $thesisRubricDetails->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisRubricDetail = ThesisRubricDetail::factory()->create();

        $response = $this->get(route('thesis-rubric-details.show', $thesisRubricDetail));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisRubricDetailController::class,
            'update',
            \App\Http\Requests\ThesisRubricDetailUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisRubricDetail = ThesisRubricDetail::factory()->create();
        $thesis_rubric = ThesisRubric::factory()->create();
        $description = $this->faker->text();
        $percentage = $this->faker->randomFloat(/** float_attributes **/);

        $response = $this->put(route('thesis-rubric-details.update', $thesisRubricDetail), [
            'thesis_rubric_id' => $thesis_rubric->id,
            'description' => $description,
            'percentage' => $percentage,
        ]);

        $thesisRubricDetail->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis_rubric->id, $thesisRubricDetail->thesis_rubric_id);
        $this->assertEquals($description, $thesisRubricDetail->description);
        $this->assertEquals($percentage, $thesisRubricDetail->percentage);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisRubricDetail = ThesisRubricDetail::factory()->create();

        $response = $this->delete(route('thesis-rubric-details.destroy', $thesisRubricDetail));

        $response->assertNoContent();

        $this->assertModelMissing($thesisRubricDetail);
    }
}
