<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Counselor;
use App\Models\CourseEnrollment;
use App\Models\Period;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CourseEnrollmentController
 */
final class CourseEnrollmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $courseEnrollments = CourseEnrollment::factory()->count(3)->create();

        $response = $this->get(route('course-enrollments.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CourseEnrollmentController::class,
            'store',
            \App\Http\Requests\CourseEnrollmentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $student = Student::factory()->create();
        $period = Period::factory()->create();
        $counselor = Counselor::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $registered_at = Carbon::parse($this->faker->date());
        $gpa = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('course-enrollments.store'), [
            'student_id' => $student->id,
            'period_id' => $period->id,
            'counselor_id' => $counselor->id,
            'status' => $status,
            'registered_at' => $registered_at->toDateString(),
            'gpa' => $gpa,
        ]);

        $courseEnrollments = CourseEnrollment::query()
            ->where('student_id', $student->id)
            ->where('period_id', $period->id)
            ->where('counselor_id', $counselor->id)
            ->where('status', $status)
            ->where('registered_at', $registered_at)
            ->where('gpa', $gpa)
            ->get();
        $this->assertCount(1, $courseEnrollments);
        $courseEnrollment = $courseEnrollments->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $courseEnrollment = CourseEnrollment::factory()->create();

        $response = $this->get(route('course-enrollments.show', $courseEnrollment));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CourseEnrollmentController::class,
            'update',
            \App\Http\Requests\CourseEnrollmentUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $courseEnrollment = CourseEnrollment::factory()->create();
        $student = Student::factory()->create();
        $period = Period::factory()->create();
        $counselor = Counselor::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $registered_at = Carbon::parse($this->faker->date());
        $gpa = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('course-enrollments.update', $courseEnrollment), [
            'student_id' => $student->id,
            'period_id' => $period->id,
            'counselor_id' => $counselor->id,
            'status' => $status,
            'registered_at' => $registered_at->toDateString(),
            'gpa' => $gpa,
        ]);

        $courseEnrollment->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($student->id, $courseEnrollment->student_id);
        $this->assertEquals($period->id, $courseEnrollment->period_id);
        $this->assertEquals($counselor->id, $courseEnrollment->counselor_id);
        $this->assertEquals($status, $courseEnrollment->status);
        $this->assertEquals($registered_at, $courseEnrollment->registered_at);
        $this->assertEquals($gpa, $courseEnrollment->gpa);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $courseEnrollment = CourseEnrollment::factory()->create();

        $response = $this->delete(route('course-enrollments.destroy', $courseEnrollment));

        $response->assertNoContent();

        $this->assertModelMissing($courseEnrollment);
    }
}
