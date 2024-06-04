<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ClassCourse;
use App\Models\ClassProblem;
use App\Models\CourseEnrollmentDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ClassProblemController
 */
final class ClassProblemControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $classProblems = ClassProblem::factory()->count(3)->create();

        $response = $this->get(route('class-problems.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassProblemController::class,
            'store',
            \App\Http\Requests\ClassProblemStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $class_course = ClassCourse::factory()->create();
        $course_enrollment_detail = CourseEnrollmentDetail::factory()->create();
        $problem = $this->faker->text();

        $response = $this->post(route('class-problems.store'), [
            'class_course_id' => $class_course->id,
            'course_enrollment_detail_id' => $course_enrollment_detail->id,
            'problem' => $problem,
        ]);

        $classProblems = ClassProblem::query()
            ->where('class_course_id', $class_course->id)
            ->where('course_enrollment_detail_id', $course_enrollment_detail->id)
            ->where('problem', $problem)
            ->get();
        $this->assertCount(1, $classProblems);
        $classProblem = $classProblems->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $classProblem = ClassProblem::factory()->create();

        $response = $this->get(route('class-problems.show', $classProblem));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassProblemController::class,
            'update',
            \App\Http\Requests\ClassProblemUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $classProblem = ClassProblem::factory()->create();
        $class_course = ClassCourse::factory()->create();
        $course_enrollment_detail = CourseEnrollmentDetail::factory()->create();
        $problem = $this->faker->text();

        $response = $this->put(route('class-problems.update', $classProblem), [
            'class_course_id' => $class_course->id,
            'course_enrollment_detail_id' => $course_enrollment_detail->id,
            'problem' => $problem,
        ]);

        $classProblem->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($class_course->id, $classProblem->class_course_id);
        $this->assertEquals($course_enrollment_detail->id, $classProblem->course_enrollment_detail_id);
        $this->assertEquals($problem, $classProblem->problem);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $classProblem = ClassProblem::factory()->create();

        $response = $this->delete(route('class-problems.destroy', $classProblem));

        $response->assertNoContent();

        $this->assertModelMissing($classProblem);
    }
}
