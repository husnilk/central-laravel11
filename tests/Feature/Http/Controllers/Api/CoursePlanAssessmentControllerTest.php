<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlan;
use App\Models\CoursePlanAssessment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanAssessmentController
 */
final class CoursePlanAssessmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanAssessments = CoursePlanAssessment::factory()->count(3)->create();

        $response = $this->get(route('course-plan-assessments.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanAssessmentController::class,
            'store',
            \App\Http\Requests\CoursePlanAssessmentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan = CoursePlan::factory()->create();
        $name = $this->faker->name();
        $percentage = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('course-plan-assessments.store'), [
            'course_plan_id' => $course_plan->id,
            'name' => $name,
            'percentage' => $percentage,
        ]);

        $coursePlanAssessments = CoursePlanAssessment::query()
            ->where('course_plan_id', $course_plan->id)
            ->where('name', $name)
            ->where('percentage', $percentage)
            ->get();
        $this->assertCount(1, $coursePlanAssessments);
        $coursePlanAssessment = $coursePlanAssessments->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanAssessment = CoursePlanAssessment::factory()->create();

        $response = $this->get(route('course-plan-assessments.show', $coursePlanAssessment));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanAssessmentController::class,
            'update',
            \App\Http\Requests\CoursePlanAssessmentUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanAssessment = CoursePlanAssessment::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $name = $this->faker->name();
        $percentage = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('course-plan-assessments.update', $coursePlanAssessment), [
            'course_plan_id' => $course_plan->id,
            'name' => $name,
            'percentage' => $percentage,
        ]);

        $coursePlanAssessment->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan->id, $coursePlanAssessment->course_plan_id);
        $this->assertEquals($name, $coursePlanAssessment->name);
        $this->assertEquals($percentage, $coursePlanAssessment->percentage);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanAssessment = CoursePlanAssessment::factory()->create();

        $response = $this->delete(route('course-plan-assessments.destroy', $coursePlanAssessment));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanAssessment);
    }
}
