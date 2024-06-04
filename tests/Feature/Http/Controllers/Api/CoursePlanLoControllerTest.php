<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlan;
use App\Models\CoursePlanLo;
use App\Models\CurriculumIndicator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanLoController
 */
final class CoursePlanLoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanLos = CoursePlanLo::factory()->count(3)->create();

        $response = $this->get(route('course-plan-los.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanLoController::class,
            'store',
            \App\Http\Requests\CoursePlanLoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan = CoursePlan::factory()->create();
        $curriculum_indicator = CurriculumIndicator::factory()->create();
        $code = $this->faker->word();
        $name = $this->faker->name();

        $response = $this->post(route('course-plan-los.store'), [
            'course_plan_id' => $course_plan->id,
            'curriculum_indicator_id' => $curriculum_indicator->id,
            'code' => $code,
            'name' => $name,
        ]);

        $coursePlanLos = CoursePlanLo::query()
            ->where('course_plan_id', $course_plan->id)
            ->where('curriculum_indicator_id', $curriculum_indicator->id)
            ->where('code', $code)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $coursePlanLos);
        $coursePlanLo = $coursePlanLos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanLo = CoursePlanLo::factory()->create();

        $response = $this->get(route('course-plan-los.show', $coursePlanLo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanLoController::class,
            'update',
            \App\Http\Requests\CoursePlanLoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanLo = CoursePlanLo::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $curriculum_indicator = CurriculumIndicator::factory()->create();
        $code = $this->faker->word();
        $name = $this->faker->name();

        $response = $this->put(route('course-plan-los.update', $coursePlanLo), [
            'course_plan_id' => $course_plan->id,
            'curriculum_indicator_id' => $curriculum_indicator->id,
            'code' => $code,
            'name' => $name,
        ]);

        $coursePlanLo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan->id, $coursePlanLo->course_plan_id);
        $this->assertEquals($curriculum_indicator->id, $coursePlanLo->curriculum_indicator_id);
        $this->assertEquals($code, $coursePlanLo->code);
        $this->assertEquals($name, $coursePlanLo->name);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanLo = CoursePlanLo::factory()->create();

        $response = $this->delete(route('course-plan-los.destroy', $coursePlanLo));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanLo);
    }
}
