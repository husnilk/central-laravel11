<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\CoursePlan;
use App\Models\Period;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ClassCourseController
 */
final class ClassCourseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $classCourses = ClassCourse::factory()->count(3)->create();

        $response = $this->get(route('class-courses.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassCourseController::class,
            'store',
            \App\Http\Requests\ClassCourseStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course = Course::factory()->create();
        $period = Period::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $name = $this->faker->name();

        $response = $this->post(route('class-courses.store'), [
            'course_id' => $course->id,
            'period_id' => $period->id,
            'course_plan_id' => $course_plan->id,
            'name' => $name,
        ]);

        $classCourses = ClassCourse::query()
            ->where('course_id', $course->id)
            ->where('period_id', $period->id)
            ->where('course_plan_id', $course_plan->id)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $classCourses);
        $classCourse = $classCourses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $classCourse = ClassCourse::factory()->create();

        $response = $this->get(route('class-courses.show', $classCourse));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassCourseController::class,
            'update',
            \App\Http\Requests\ClassCourseUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $classCourse = ClassCourse::factory()->create();
        $course = Course::factory()->create();
        $period = Period::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('class-courses.update', $classCourse), [
            'course_id' => $course->id,
            'period_id' => $period->id,
            'course_plan_id' => $course_plan->id,
            'name' => $name,
        ]);

        $classCourse->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course->id, $classCourse->course_id);
        $this->assertEquals($period->id, $classCourse->period_id);
        $this->assertEquals($course_plan->id, $classCourse->course_plan_id);
        $this->assertEquals($name, $classCourse->name);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $classCourse = ClassCourse::factory()->create();

        $response = $this->delete(route('class-courses.destroy', $classCourse));

        $response->assertNoContent();

        $this->assertModelMissing($classCourse);
    }
}
