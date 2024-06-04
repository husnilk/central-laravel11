<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlan;
use App\Models\CoursePlanMedia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanMediaController
 */
final class CoursePlanMediaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanMedia = CoursePlanMedia::factory()->count(3)->create();

        $response = $this->get(route('course-plan-medias.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanMediaController::class,
            'store',
            \App\Http\Requests\CoursePlanMediaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan = CoursePlan::factory()->create();
        $type = $this->faker->numberBetween(-10000, 10000);
        $media = $this->faker->word();

        $response = $this->post(route('course-plan-medias.store'), [
            'course_plan_id' => $course_plan->id,
            'type' => $type,
            'media' => $media,
        ]);

        $coursePlanMedia = CoursePlanMedia::query()
            ->where('course_plan_id', $course_plan->id)
            ->where('type', $type)
            ->where('media', $media)
            ->get();
        $this->assertCount(1, $coursePlanMedia);
        $coursePlanMedia = $coursePlanMedia->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanMedia = CoursePlanMedia::factory()->create();

        $response = $this->get(route('course-plan-medias.show', $coursePlanMedia));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanMediaController::class,
            'update',
            \App\Http\Requests\CoursePlanMediaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanMedia = CoursePlanMedia::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $type = $this->faker->numberBetween(-10000, 10000);
        $media = $this->faker->word();

        $response = $this->put(route('course-plan-medias.update', $coursePlanMedia), [
            'course_plan_id' => $course_plan->id,
            'type' => $type,
            'media' => $media,
        ]);

        $coursePlanMedia->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan->id, $coursePlanMedia->course_plan_id);
        $this->assertEquals($type, $coursePlanMedia->type);
        $this->assertEquals($media, $coursePlanMedia->media);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanMedia = CoursePlanMedia::factory()->create();

        $response = $this->delete(route('course-plan-medias.destroy', $coursePlanMedia));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanMedia);
    }
}
