<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ClassAttendance;
use App\Models\ClassMeeting;
use App\Models\CourseEnrollmentDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ClassAttendanceController
 */
final class ClassAttendanceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $classAttendances = ClassAttendance::factory()->count(3)->create();

        $response = $this->get(route('class-attendances.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassAttendanceController::class,
            'store',
            \App\Http\Requests\ClassAttendanceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_enrollment_detail = CourseEnrollmentDetail::factory()->create();
        $class_meeting = ClassMeeting::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $meet_no = $this->faker->numberBetween(-10000, 10000);
        $attendance_status = $this->faker->numberBetween(-10000, 10000);
        $need_attention = $this->faker->numberBetween(-10000, 10000);
        $information = $this->faker->text();

        $response = $this->post(route('class-attendances.store'), [
            'course_enrollment_detail_id' => $course_enrollment_detail->id,
            'class_meeting_id' => $class_meeting->id,
            'status' => $status,
            'meet_no' => $meet_no,
            'attendance_status' => $attendance_status,
            'need_attention' => $need_attention,
            'information' => $information,
        ]);

        $classAttendances = ClassAttendance::query()
            ->where('course_enrollment_detail_id', $course_enrollment_detail->id)
            ->where('class_meeting_id', $class_meeting->id)
            ->where('status', $status)
            ->where('meet_no', $meet_no)
            ->where('attendance_status', $attendance_status)
            ->where('need_attention', $need_attention)
            ->where('information', $information)
            ->get();
        $this->assertCount(1, $classAttendances);
        $classAttendance = $classAttendances->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $classAttendance = ClassAttendance::factory()->create();

        $response = $this->get(route('class-attendances.show', $classAttendance));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassAttendanceController::class,
            'update',
            \App\Http\Requests\ClassAttendanceUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $classAttendance = ClassAttendance::factory()->create();
        $course_enrollment_detail = CourseEnrollmentDetail::factory()->create();
        $class_meeting = ClassMeeting::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $meet_no = $this->faker->numberBetween(-10000, 10000);
        $attendance_status = $this->faker->numberBetween(-10000, 10000);
        $need_attention = $this->faker->numberBetween(-10000, 10000);
        $information = $this->faker->text();

        $response = $this->put(route('class-attendances.update', $classAttendance), [
            'course_enrollment_detail_id' => $course_enrollment_detail->id,
            'class_meeting_id' => $class_meeting->id,
            'status' => $status,
            'meet_no' => $meet_no,
            'attendance_status' => $attendance_status,
            'need_attention' => $need_attention,
            'information' => $information,
        ]);

        $classAttendance->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_enrollment_detail->id, $classAttendance->course_enrollment_detail_id);
        $this->assertEquals($class_meeting->id, $classAttendance->class_meeting_id);
        $this->assertEquals($status, $classAttendance->status);
        $this->assertEquals($meet_no, $classAttendance->meet_no);
        $this->assertEquals($attendance_status, $classAttendance->attendance_status);
        $this->assertEquals($need_attention, $classAttendance->need_attention);
        $this->assertEquals($information, $classAttendance->information);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $classAttendance = ClassAttendance::factory()->create();

        $response = $this->delete(route('class-attendances.destroy', $classAttendance));

        $response->assertNoContent();

        $this->assertModelMissing($classAttendance);
    }
}
