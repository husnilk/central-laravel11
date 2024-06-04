<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\AssessmentCriteria;
use App\Models\AssessmentCriterion;
use App\Models\AssessmentDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\AssessmentCriteriaController
 */
final class AssessmentCriteriaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $assessmentCriteria = AssessmentCriteria::factory()->count(3)->create();

        $response = $this->get(route('assessment-criteria.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\AssessmentCriteriaController::class,
            'store',
            \App\Http\Requests\AssessmentCriteriaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $assessment_detail = AssessmentDetail::factory()->create();
        $criteria = $this->faker->word();

        $response = $this->post(route('assessment-criteria.store'), [
            'assessment_detail_id' => $assessment_detail->id,
            'criteria' => $criteria,
        ]);

        $assessmentCriteria = AssessmentCriterion::query()
            ->where('assessment_detail_id', $assessment_detail->id)
            ->where('criteria', $criteria)
            ->get();
        $this->assertCount(1, $assessmentCriteria);
        $assessmentCriterion = $assessmentCriteria->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $assessmentCriterion = AssessmentCriteria::factory()->create();

        $response = $this->get(route('assessment-criteria.show', $assessmentCriterion));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\AssessmentCriteriaController::class,
            'update',
            \App\Http\Requests\AssessmentCriteriaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $assessmentCriterion = AssessmentCriteria::factory()->create();
        $assessment_detail = AssessmentDetail::factory()->create();
        $criteria = $this->faker->word();

        $response = $this->put(route('assessment-criteria.update', $assessmentCriterion), [
            'assessment_detail_id' => $assessment_detail->id,
            'criteria' => $criteria,
        ]);

        $assessmentCriterion->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($assessment_detail->id, $assessmentCriterion->assessment_detail_id);
        $this->assertEquals($criteria, $assessmentCriterion->criteria);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $assessmentCriterion = AssessmentCriteria::factory()->create();
        $assessmentCriterion = AssessmentCriterion::factory()->create();

        $response = $this->delete(route('assessment-criteria.destroy', $assessmentCriterion));

        $response->assertNoContent();

        $this->assertModelMissing($assessmentCriterion);
    }
}
