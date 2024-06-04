<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\AssessmentCriteria;
use App\Models\AssessmentRubric;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\AssessmentRubricController
 */
final class AssessmentRubricControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $assessmentRubrics = AssessmentRubric::factory()->count(3)->create();

        $response = $this->get(route('assessment-rubrics.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\AssessmentRubricController::class,
            'store',
            \App\Http\Requests\AssessmentRubricStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $assessment_criteria = AssessmentCriteria::factory()->create();
        $grade = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('assessment-rubrics.store'), [
            'assessment_criteria_id' => $assessment_criteria->id,
            'grade' => $grade,
        ]);

        $assessmentRubrics = AssessmentRubric::query()
            ->where('assessment_criteria_id', $assessment_criteria->id)
            ->where('grade', $grade)
            ->get();
        $this->assertCount(1, $assessmentRubrics);
        $assessmentRubric = $assessmentRubrics->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $assessmentRubric = AssessmentRubric::factory()->create();

        $response = $this->get(route('assessment-rubrics.show', $assessmentRubric));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\AssessmentRubricController::class,
            'update',
            \App\Http\Requests\AssessmentRubricUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $assessmentRubric = AssessmentRubric::factory()->create();
        $assessment_criteria = AssessmentCriteria::factory()->create();
        $grade = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('assessment-rubrics.update', $assessmentRubric), [
            'assessment_criteria_id' => $assessment_criteria->id,
            'grade' => $grade,
        ]);

        $assessmentRubric->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($assessment_criteria->id, $assessmentRubric->assessment_criteria_id);
        $this->assertEquals($grade, $assessmentRubric->grade);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $assessmentRubric = AssessmentRubric::factory()->create();

        $response = $this->delete(route('assessment-rubrics.destroy', $assessmentRubric));

        $response->assertNoContent();

        $this->assertModelMissing($assessmentRubric);
    }
}
