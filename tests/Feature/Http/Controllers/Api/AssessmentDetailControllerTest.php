<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\AssessmentDetail;
use App\Models\CoursePlanAssessment;
use App\Models\CoursePlanLo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\AssessmentDetailController
 */
final class AssessmentDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $assessmentDetails = AssessmentDetail::factory()->count(3)->create();

        $response = $this->get(route('assessment-details.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\AssessmentDetailController::class,
            'store',
            \App\Http\Requests\AssessmentDetailStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan_assessment = CoursePlanAssessment::factory()->create();
        $course_plan_lo = CoursePlanLo::factory()->create();
        $percentage = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('assessment-details.store'), [
            'course_plan_assessment_id' => $course_plan_assessment->id,
            'course_plan_lo_id' => $course_plan_lo->id,
            'percentage' => $percentage,
        ]);

        $assessmentDetails = AssessmentDetail::query()
            ->where('course_plan_assessment_id', $course_plan_assessment->id)
            ->where('course_plan_lo_id', $course_plan_lo->id)
            ->where('percentage', $percentage)
            ->get();
        $this->assertCount(1, $assessmentDetails);
        $assessmentDetail = $assessmentDetails->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $assessmentDetail = AssessmentDetail::factory()->create();

        $response = $this->get(route('assessment-details.show', $assessmentDetail));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\AssessmentDetailController::class,
            'update',
            \App\Http\Requests\AssessmentDetailUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $assessmentDetail = AssessmentDetail::factory()->create();
        $course_plan_assessment = CoursePlanAssessment::factory()->create();
        $course_plan_lo = CoursePlanLo::factory()->create();
        $percentage = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('assessment-details.update', $assessmentDetail), [
            'course_plan_assessment_id' => $course_plan_assessment->id,
            'course_plan_lo_id' => $course_plan_lo->id,
            'percentage' => $percentage,
        ]);

        $assessmentDetail->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan_assessment->id, $assessmentDetail->course_plan_assessment_id);
        $this->assertEquals($course_plan_lo->id, $assessmentDetail->course_plan_lo_id);
        $this->assertEquals($percentage, $assessmentDetail->percentage);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $assessmentDetail = AssessmentDetail::factory()->create();

        $response = $this->delete(route('assessment-details.destroy', $assessmentDetail));

        $response->assertNoContent();

        $this->assertModelMissing($assessmentDetail);
    }
}
