<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlan;
use App\Models\CoursePlanLecturer;
use App\Models\Lecturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanLecturerController
 */
final class CoursePlanLecturerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanLecturers = CoursePlanLecturer::factory()->count(3)->create();

        $response = $this->get(route('course-plan-lecturers.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanLecturerController::class,
            'store',
            \App\Http\Requests\CoursePlanLecturerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan = CoursePlan::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $creator = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('course-plan-lecturers.store'), [
            'course_plan_id' => $course_plan->id,
            'lecturer_id' => $lecturer->id,
            'creator' => $creator,
        ]);

        $coursePlanLecturers = CoursePlanLecturer::query()
            ->where('course_plan_id', $course_plan->id)
            ->where('lecturer_id', $lecturer->id)
            ->where('creator', $creator)
            ->get();
        $this->assertCount(1, $coursePlanLecturers);
        $coursePlanLecturer = $coursePlanLecturers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanLecturer = CoursePlanLecturer::factory()->create();

        $response = $this->get(route('course-plan-lecturers.show', $coursePlanLecturer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanLecturerController::class,
            'update',
            \App\Http\Requests\CoursePlanLecturerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanLecturer = CoursePlanLecturer::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $creator = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('course-plan-lecturers.update', $coursePlanLecturer), [
            'course_plan_id' => $course_plan->id,
            'lecturer_id' => $lecturer->id,
            'creator' => $creator,
        ]);

        $coursePlanLecturer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan->id, $coursePlanLecturer->course_plan_id);
        $this->assertEquals($lecturer->id, $coursePlanLecturer->lecturer_id);
        $this->assertEquals($creator, $coursePlanLecturer->creator);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanLecturer = CoursePlanLecturer::factory()->create();

        $response = $this->delete(route('course-plan-lecturers.destroy', $coursePlanLecturer));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanLecturer);
    }
}
