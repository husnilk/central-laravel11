<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Course;
use App\Models\CourseCurriculumIndicator;
use App\Models\CurriculumIndicator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CourseCurriculumIndicatorController
 */
final class CourseCurriculumIndicatorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $courseCurriculumIndicators = CourseCurriculumIndicator::factory()->count(3)->create();

        $response = $this->get(route('course-curriculum-indicators.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CourseCurriculumIndicatorController::class,
            'store',
            \App\Http\Requests\CourseCurriculumIndicatorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course = Course::factory()->create();
        $curriculum_indicator = CurriculumIndicator::factory()->create();

        $response = $this->post(route('course-curriculum-indicators.store'), [
            'course_id' => $course->id,
            'curriculum_indicator_id' => $curriculum_indicator->id,
        ]);

        $courseCurriculumIndicators = CourseCurriculumIndicator::query()
            ->where('course_id', $course->id)
            ->where('curriculum_indicator_id', $curriculum_indicator->id)
            ->get();
        $this->assertCount(1, $courseCurriculumIndicators);
        $courseCurriculumIndicator = $courseCurriculumIndicators->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $courseCurriculumIndicator = CourseCurriculumIndicator::factory()->create();

        $response = $this->get(route('course-curriculum-indicators.show', $courseCurriculumIndicator));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CourseCurriculumIndicatorController::class,
            'update',
            \App\Http\Requests\CourseCurriculumIndicatorUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $courseCurriculumIndicator = CourseCurriculumIndicator::factory()->create();
        $course = Course::factory()->create();
        $curriculum_indicator = CurriculumIndicator::factory()->create();

        $response = $this->put(route('course-curriculum-indicators.update', $courseCurriculumIndicator), [
            'course_id' => $course->id,
            'curriculum_indicator_id' => $curriculum_indicator->id,
        ]);

        $courseCurriculumIndicator->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course->id, $courseCurriculumIndicator->course_id);
        $this->assertEquals($curriculum_indicator->id, $courseCurriculumIndicator->curriculum_indicator_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $courseCurriculumIndicator = CourseCurriculumIndicator::factory()->create();

        $response = $this->delete(route('course-curriculum-indicators.destroy', $courseCurriculumIndicator));

        $response->assertNoContent();

        $this->assertModelMissing($courseCurriculumIndicator);
    }
}
