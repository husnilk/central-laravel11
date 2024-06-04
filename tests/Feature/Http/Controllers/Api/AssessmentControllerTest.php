<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Assessment;
use App\Models\AssessmentDetail;
use App\Models\CourseEnrollmentDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\AssessmentController
 */
final class AssessmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $assessments = Assessment::factory()->count(3)->create();

        $response = $this->get(route('assessments.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\AssessmentController::class,
            'store',
            \App\Http\Requests\AssessmentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $assessment_detail = AssessmentDetail::factory()->create();
        $course_enrollment_detail = CourseEnrollmentDetail::factory()->create();
        $grade = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('assessments.store'), [
            'assessment_detail_id' => $assessment_detail->id,
            'course_enrollment_detail_id' => $course_enrollment_detail->id,
            'grade' => $grade,
        ]);

        $assessments = Assessment::query()
            ->where('assessment_detail_id', $assessment_detail->id)
            ->where('course_enrollment_detail_id', $course_enrollment_detail->id)
            ->where('grade', $grade)
            ->get();
        $this->assertCount(1, $assessments);
        $assessment = $assessments->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $assessment = Assessment::factory()->create();

        $response = $this->get(route('assessments.show', $assessment));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\AssessmentController::class,
            'update',
            \App\Http\Requests\AssessmentUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $assessment = Assessment::factory()->create();
        $assessment_detail = AssessmentDetail::factory()->create();
        $course_enrollment_detail = CourseEnrollmentDetail::factory()->create();
        $grade = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('assessments.update', $assessment), [
            'assessment_detail_id' => $assessment_detail->id,
            'course_enrollment_detail_id' => $course_enrollment_detail->id,
            'grade' => $grade,
        ]);

        $assessment->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($assessment_detail->id, $assessment->assessment_detail_id);
        $this->assertEquals($course_enrollment_detail->id, $assessment->course_enrollment_detail_id);
        $this->assertEquals($grade, $assessment->grade);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $assessment = Assessment::factory()->create();

        $response = $this->delete(route('assessments.destroy', $assessment));

        $response->assertNoContent();

        $this->assertModelMissing($assessment);
    }
}
