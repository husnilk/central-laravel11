<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Class;
use App\Models\ClassCourse;
use App\Models\ClassLecturer;
use App\Models\Lecturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ClassLecturerController
 */
final class ClassLecturerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $classLecturers = ClassLecturer::factory()->count(3)->create();

        $response = $this->get(route('class-lecturers.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassLecturerController::class,
            'store',
            \App\Http\Requests\ClassLecturerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $class = Class::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);
        $grading = $this->faker->numberBetween(-10000, 10000);
        $class_course = ClassCourse::factory()->create();

        $response = $this->post(route('class-lecturers.store'), [
            'class_id' => $class->id,
            'lecturer_id' => $lecturer->id,
            'position' => $position,
            'grading' => $grading,
            'class_course_id' => $class_course->id,
        ]);

        $classLecturers = ClassLecturer::query()
            ->where('class_id', $class->id)
            ->where('lecturer_id', $lecturer->id)
            ->where('position', $position)
            ->where('grading', $grading)
            ->where('class_course_id', $class_course->id)
            ->get();
        $this->assertCount(1, $classLecturers);
        $classLecturer = $classLecturers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $classLecturer = ClassLecturer::factory()->create();

        $response = $this->get(route('class-lecturers.show', $classLecturer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassLecturerController::class,
            'update',
            \App\Http\Requests\ClassLecturerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $classLecturer = ClassLecturer::factory()->create();
        $class = Class::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);
        $grading = $this->faker->numberBetween(-10000, 10000);
        $class_course = ClassCourse::factory()->create();

        $response = $this->put(route('class-lecturers.update', $classLecturer), [
            'class_id' => $class->id,
            'lecturer_id' => $lecturer->id,
            'position' => $position,
            'grading' => $grading,
            'class_course_id' => $class_course->id,
        ]);

        $classLecturer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($class->id, $classLecturer->class_id);
        $this->assertEquals($lecturer->id, $classLecturer->lecturer_id);
        $this->assertEquals($position, $classLecturer->position);
        $this->assertEquals($grading, $classLecturer->grading);
        $this->assertEquals($class_course->id, $classLecturer->class_course_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $classLecturer = ClassLecturer::factory()->create();

        $response = $this->delete(route('class-lecturers.destroy', $classLecturer));

        $response->assertNoContent();

        $this->assertModelMissing($classLecturer);
    }
}
