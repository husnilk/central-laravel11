<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlan;
use App\Models\CoursePlanRequirement;
use App\Models\ReqCourse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanRequirementController
 */
final class CoursePlanRequirementControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanRequirements = CoursePlanRequirement::factory()->count(3)->create();

        $response = $this->get(route('course-plan-requirements.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanRequirementController::class,
            'store',
            \App\Http\Requests\CoursePlanRequirementStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan = CoursePlan::factory()->create();
        $req_course = ReqCourse::factory()->create();
        $req_level = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('course-plan-requirements.store'), [
            'course_plan_id' => $course_plan->id,
            'req_course_id' => $req_course->id,
            'req_level' => $req_level,
        ]);

        $coursePlanRequirements = CoursePlanRequirement::query()
            ->where('course_plan_id', $course_plan->id)
            ->where('req_course_id', $req_course->id)
            ->where('req_level', $req_level)
            ->get();
        $this->assertCount(1, $coursePlanRequirements);
        $coursePlanRequirement = $coursePlanRequirements->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanRequirement = CoursePlanRequirement::factory()->create();

        $response = $this->get(route('course-plan-requirements.show', $coursePlanRequirement));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanRequirementController::class,
            'update',
            \App\Http\Requests\CoursePlanRequirementUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanRequirement = CoursePlanRequirement::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $req_course = ReqCourse::factory()->create();
        $req_level = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('course-plan-requirements.update', $coursePlanRequirement), [
            'course_plan_id' => $course_plan->id,
            'req_course_id' => $req_course->id,
            'req_level' => $req_level,
        ]);

        $coursePlanRequirement->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan->id, $coursePlanRequirement->course_plan_id);
        $this->assertEquals($req_course->id, $coursePlanRequirement->req_course_id);
        $this->assertEquals($req_level, $coursePlanRequirement->req_level);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanRequirement = CoursePlanRequirement::factory()->create();

        $response = $this->delete(route('course-plan-requirements.destroy', $coursePlanRequirement));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanRequirement);
    }
}
