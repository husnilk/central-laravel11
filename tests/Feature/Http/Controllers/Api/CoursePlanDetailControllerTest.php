<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlan;
use App\Models\CoursePlanDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanDetailController
 */
final class CoursePlanDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanDetails = CoursePlanDetail::factory()->count(3)->create();

        $response = $this->get(route('course-plan-details.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanDetailController::class,
            'store',
            \App\Http\Requests\CoursePlanDetailStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan = CoursePlan::factory()->create();
        $week = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('course-plan-details.store'), [
            'course_plan_id' => $course_plan->id,
            'week' => $week,
        ]);

        $coursePlanDetails = CoursePlanDetail::query()
            ->where('course_plan_id', $course_plan->id)
            ->where('week', $week)
            ->get();
        $this->assertCount(1, $coursePlanDetails);
        $coursePlanDetail = $coursePlanDetails->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanDetail = CoursePlanDetail::factory()->create();

        $response = $this->get(route('course-plan-details.show', $coursePlanDetail));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanDetailController::class,
            'update',
            \App\Http\Requests\CoursePlanDetailUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanDetail = CoursePlanDetail::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $week = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('course-plan-details.update', $coursePlanDetail), [
            'course_plan_id' => $course_plan->id,
            'week' => $week,
        ]);

        $coursePlanDetail->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan->id, $coursePlanDetail->course_plan_id);
        $this->assertEquals($week, $coursePlanDetail->week);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanDetail = CoursePlanDetail::factory()->create();

        $response = $this->delete(route('course-plan-details.destroy', $coursePlanDetail));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanDetail);
    }
}
