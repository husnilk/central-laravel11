<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlanDetail;
use App\Models\CoursePlanDetailActivity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanDetailActivityController
 */
final class CoursePlanDetailActivityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanDetailActivities = CoursePlanDetailActivity::factory()->count(3)->create();

        $response = $this->get(route('course-plan-detail-activities.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanDetailActivityController::class,
            'store',
            \App\Http\Requests\CoursePlanDetailActivityStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan_detail = CoursePlanDetail::factory()->create();
        $activity = $this->faker->numberBetween(-10000, 10000);
        $student_activity = $this->faker->text();

        $response = $this->post(route('course-plan-detail-activities.store'), [
            'course_plan_detail_id' => $course_plan_detail->id,
            'activity' => $activity,
            'student_activity' => $student_activity,
        ]);

        $coursePlanDetailActivities = CoursePlanDetailActivity::query()
            ->where('course_plan_detail_id', $course_plan_detail->id)
            ->where('activity', $activity)
            ->where('student_activity', $student_activity)
            ->get();
        $this->assertCount(1, $coursePlanDetailActivities);
        $coursePlanDetailActivity = $coursePlanDetailActivities->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanDetailActivity = CoursePlanDetailActivity::factory()->create();

        $response = $this->get(route('course-plan-detail-activities.show', $coursePlanDetailActivity));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanDetailActivityController::class,
            'update',
            \App\Http\Requests\CoursePlanDetailActivityUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanDetailActivity = CoursePlanDetailActivity::factory()->create();
        $course_plan_detail = CoursePlanDetail::factory()->create();
        $activity = $this->faker->numberBetween(-10000, 10000);
        $student_activity = $this->faker->text();

        $response = $this->put(route('course-plan-detail-activities.update', $coursePlanDetailActivity), [
            'course_plan_detail_id' => $course_plan_detail->id,
            'activity' => $activity,
            'student_activity' => $student_activity,
        ]);

        $coursePlanDetailActivity->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan_detail->id, $coursePlanDetailActivity->course_plan_detail_id);
        $this->assertEquals($activity, $coursePlanDetailActivity->activity);
        $this->assertEquals($student_activity, $coursePlanDetailActivity->student_activity);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanDetailActivity = CoursePlanDetailActivity::factory()->create();

        $response = $this->delete(route('course-plan-detail-activities.destroy', $coursePlanDetailActivity));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanDetailActivity);
    }
}
