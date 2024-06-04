<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CourseController
 */
final class CourseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $courses = Course::factory()->count(3)->create();

        $response = $this->get(route('courses.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CourseController::class,
            'store',
            \App\Http\Requests\CourseStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $curriculum = Curriculum::factory()->create();
        $code = $this->faker->word();
        $name = $this->faker->name();
        $credit = $this->faker->numberBetween(-10000, 10000);
        $semester = $this->faker->numberBetween(-10000, 10000);
        $mandatory = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('courses.store'), [
            'curriculum_id' => $curriculum->id,
            'code' => $code,
            'name' => $name,
            'credit' => $credit,
            'semester' => $semester,
            'mandatory' => $mandatory,
        ]);

        $courses = Course::query()
            ->where('curriculum_id', $curriculum->id)
            ->where('code', $code)
            ->where('name', $name)
            ->where('credit', $credit)
            ->where('semester', $semester)
            ->where('mandatory', $mandatory)
            ->get();
        $this->assertCount(1, $courses);
        $course = $courses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $course = Course::factory()->create();

        $response = $this->get(route('courses.show', $course));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CourseController::class,
            'update',
            \App\Http\Requests\CourseUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $course = Course::factory()->create();
        $curriculum = Curriculum::factory()->create();
        $code = $this->faker->word();
        $name = $this->faker->name();
        $credit = $this->faker->numberBetween(-10000, 10000);
        $semester = $this->faker->numberBetween(-10000, 10000);
        $mandatory = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('courses.update', $course), [
            'curriculum_id' => $curriculum->id,
            'code' => $code,
            'name' => $name,
            'credit' => $credit,
            'semester' => $semester,
            'mandatory' => $mandatory,
        ]);

        $course->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($curriculum->id, $course->curriculum_id);
        $this->assertEquals($code, $course->code);
        $this->assertEquals($name, $course->name);
        $this->assertEquals($credit, $course->credit);
        $this->assertEquals($semester, $course->semester);
        $this->assertEquals($mandatory, $course->mandatory);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $course = Course::factory()->create();

        $response = $this->delete(route('courses.destroy', $course));

        $response->assertNoContent();

        $this->assertModelMissing($course);
    }
}
