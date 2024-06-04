<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlan;
use App\Models\CoursePlanMaterial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanMaterialController
 */
final class CoursePlanMaterialControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanMaterials = CoursePlanMaterial::factory()->count(3)->create();

        $response = $this->get(route('course-plan-materials.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanMaterialController::class,
            'store',
            \App\Http\Requests\CoursePlanMaterialStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan = CoursePlan::factory()->create();
        $topic = $this->faker->word();

        $response = $this->post(route('course-plan-materials.store'), [
            'course_plan_id' => $course_plan->id,
            'topic' => $topic,
        ]);

        $coursePlanMaterials = CoursePlanMaterial::query()
            ->where('course_plan_id', $course_plan->id)
            ->where('topic', $topic)
            ->get();
        $this->assertCount(1, $coursePlanMaterials);
        $coursePlanMaterial = $coursePlanMaterials->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanMaterial = CoursePlanMaterial::factory()->create();

        $response = $this->get(route('course-plan-materials.show', $coursePlanMaterial));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanMaterialController::class,
            'update',
            \App\Http\Requests\CoursePlanMaterialUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanMaterial = CoursePlanMaterial::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $topic = $this->faker->word();

        $response = $this->put(route('course-plan-materials.update', $coursePlanMaterial), [
            'course_plan_id' => $course_plan->id,
            'topic' => $topic,
        ]);

        $coursePlanMaterial->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan->id, $coursePlanMaterial->course_plan_id);
        $this->assertEquals($topic, $coursePlanMaterial->topic);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanMaterial = CoursePlanMaterial::factory()->create();

        $response = $this->delete(route('course-plan-materials.destroy', $coursePlanMaterial));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanMaterial);
    }
}
