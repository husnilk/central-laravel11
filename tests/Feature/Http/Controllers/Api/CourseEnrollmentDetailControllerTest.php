<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Class;
use App\Models\ClassCourse;
use App\Models\CourseEnrollment;
use App\Models\CourseEnrollmentDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CourseEnrollmentDetailController
 */
final class CourseEnrollmentDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $courseEnrollmentDetails = CourseEnrollmentDetail::factory()->count(3)->create();

        $response = $this->get(route('course-enrollment-details.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CourseEnrollmentDetailController::class,
            'store',
            \App\Http\Requests\CourseEnrollmentDetailStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_enrollment = CourseEnrollment::factory()->create();
        $class = Class::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $in_transcript = $this->faker->numberBetween(-10000, 10000);
        $class_course = ClassCourse::factory()->create();

        $response = $this->post(route('course-enrollment-details.store'), [
            'course_enrollment_id' => $course_enrollment->id,
            'class_id' => $class->id,
            'status' => $status,
            'in_transcript' => $in_transcript,
            'class_course_id' => $class_course->id,
        ]);

        $courseEnrollmentDetails = CourseEnrollmentDetail::query()
            ->where('course_enrollment_id', $course_enrollment->id)
            ->where('class_id', $class->id)
            ->where('status', $status)
            ->where('in_transcript', $in_transcript)
            ->where('class_course_id', $class_course->id)
            ->get();
        $this->assertCount(1, $courseEnrollmentDetails);
        $courseEnrollmentDetail = $courseEnrollmentDetails->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $courseEnrollmentDetail = CourseEnrollmentDetail::factory()->create();

        $response = $this->get(route('course-enrollment-details.show', $courseEnrollmentDetail));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CourseEnrollmentDetailController::class,
            'update',
            \App\Http\Requests\CourseEnrollmentDetailUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $courseEnrollmentDetail = CourseEnrollmentDetail::factory()->create();
        $course_enrollment = CourseEnrollment::factory()->create();
        $class = Class::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $in_transcript = $this->faker->numberBetween(-10000, 10000);
        $class_course = ClassCourse::factory()->create();

        $response = $this->put(route('course-enrollment-details.update', $courseEnrollmentDetail), [
            'course_enrollment_id' => $course_enrollment->id,
            'class_id' => $class->id,
            'status' => $status,
            'in_transcript' => $in_transcript,
            'class_course_id' => $class_course->id,
        ]);

        $courseEnrollmentDetail->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_enrollment->id, $courseEnrollmentDetail->course_enrollment_id);
        $this->assertEquals($class->id, $courseEnrollmentDetail->class_id);
        $this->assertEquals($status, $courseEnrollmentDetail->status);
        $this->assertEquals($in_transcript, $courseEnrollmentDetail->in_transcript);
        $this->assertEquals($class_course->id, $courseEnrollmentDetail->class_course_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $courseEnrollmentDetail = CourseEnrollmentDetail::factory()->create();

        $response = $this->delete(route('course-enrollment-details.destroy', $courseEnrollmentDetail));

        $response->assertNoContent();

        $this->assertModelMissing($courseEnrollmentDetail);
    }
}
