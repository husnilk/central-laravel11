<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Course;
use App\Models\CoursePlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanController
 */
final class CoursePlanControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlans = CoursePlan::factory()->count(3)->create();

        $response = $this->get(route('course-plans.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanController::class,
            'store',
            \App\Http\Requests\CoursePlanStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course = Course::factory()->create();
        $rev = $this->faker->numberBetween(-10000, 10000);
        $code = $this->faker->word();
        $name = $this->faker->name();
        $credit = $this->faker->numberBetween(-10000, 10000);
        $semester = $this->faker->numberBetween(-10000, 10000);
        $mandatory = $this->faker->numberBetween(-10000, 10000);
        $description = $this->faker->text();

        $response = $this->post(route('course-plans.store'), [
            'course_id' => $course->id,
            'rev' => $rev,
            'code' => $code,
            'name' => $name,
            'credit' => $credit,
            'semester' => $semester,
            'mandatory' => $mandatory,
            'description' => $description,
        ]);

        $coursePlans = CoursePlan::query()
            ->where('course_id', $course->id)
            ->where('rev', $rev)
            ->where('code', $code)
            ->where('name', $name)
            ->where('credit', $credit)
            ->where('semester', $semester)
            ->where('mandatory', $mandatory)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $coursePlans);
        $coursePlan = $coursePlans->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlan = CoursePlan::factory()->create();

        $response = $this->get(route('course-plans.show', $coursePlan));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanController::class,
            'update',
            \App\Http\Requests\CoursePlanUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlan = CoursePlan::factory()->create();
        $course = Course::factory()->create();
        $rev = $this->faker->numberBetween(-10000, 10000);
        $code = $this->faker->word();
        $name = $this->faker->name();
        $credit = $this->faker->numberBetween(-10000, 10000);
        $semester = $this->faker->numberBetween(-10000, 10000);
        $mandatory = $this->faker->numberBetween(-10000, 10000);
        $description = $this->faker->text();

        $response = $this->put(route('course-plans.update', $coursePlan), [
            'course_id' => $course->id,
            'rev' => $rev,
            'code' => $code,
            'name' => $name,
            'credit' => $credit,
            'semester' => $semester,
            'mandatory' => $mandatory,
            'description' => $description,
        ]);

        $coursePlan->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course->id, $coursePlan->course_id);
        $this->assertEquals($rev, $coursePlan->rev);
        $this->assertEquals($code, $coursePlan->code);
        $this->assertEquals($name, $coursePlan->name);
        $this->assertEquals($credit, $coursePlan->credit);
        $this->assertEquals($semester, $coursePlan->semester);
        $this->assertEquals($mandatory, $coursePlan->mandatory);
        $this->assertEquals($description, $coursePlan->description);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlan = CoursePlan::factory()->create();

        $response = $this->delete(route('course-plans.destroy', $coursePlan));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlan);
    }
}
