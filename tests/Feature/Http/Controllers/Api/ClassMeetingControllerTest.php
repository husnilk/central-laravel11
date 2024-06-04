<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Class;
use App\Models\ClassCourse;
use App\Models\ClassLecturer;
use App\Models\ClassMeeting;
use App\Models\CoursePlanDetail;
use App\Models\Lecturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ClassMeetingController
 */
final class ClassMeetingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $classMeetings = ClassMeeting::factory()->count(3)->create();

        $response = $this->get(route('class-meetings.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassMeetingController::class,
            'store',
            \App\Http\Requests\ClassMeetingStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $meet_no = $this->faker->numberBetween(-10000, 10000);
        $class = Class::factory()->create();
        $course_plan_detail = CoursePlanDetail::factory()->create();
        $class_lecturer = ClassLecturer::factory()->create();
        $material_real = $this->faker->text();
        $assessment_real = $this->faker->text();
        $method = $this->faker->numberBetween(-10000, 10000);
        $class_course = ClassCourse::factory()->create();
        $lecturer = Lecturer::factory()->create();

        $response = $this->post(route('class-meetings.store'), [
            'meet_no' => $meet_no,
            'class_id' => $class->id,
            'course_plan_detail_id' => $course_plan_detail->id,
            'class_lecturer_id' => $class_lecturer->id,
            'material_real' => $material_real,
            'assessment_real' => $assessment_real,
            'method' => $method,
            'class_course_id' => $class_course->id,
            'lecturer_id' => $lecturer->id,
        ]);

        $classMeetings = ClassMeeting::query()
            ->where('meet_no', $meet_no)
            ->where('class_id', $class->id)
            ->where('course_plan_detail_id', $course_plan_detail->id)
            ->where('class_lecturer_id', $class_lecturer->id)
            ->where('material_real', $material_real)
            ->where('assessment_real', $assessment_real)
            ->where('method', $method)
            ->where('class_course_id', $class_course->id)
            ->where('lecturer_id', $lecturer->id)
            ->get();
        $this->assertCount(1, $classMeetings);
        $classMeeting = $classMeetings->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $classMeeting = ClassMeeting::factory()->create();

        $response = $this->get(route('class-meetings.show', $classMeeting));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassMeetingController::class,
            'update',
            \App\Http\Requests\ClassMeetingUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $classMeeting = ClassMeeting::factory()->create();
        $meet_no = $this->faker->numberBetween(-10000, 10000);
        $class = Class::factory()->create();
        $course_plan_detail = CoursePlanDetail::factory()->create();
        $class_lecturer = ClassLecturer::factory()->create();
        $material_real = $this->faker->text();
        $assessment_real = $this->faker->text();
        $method = $this->faker->numberBetween(-10000, 10000);
        $class_course = ClassCourse::factory()->create();
        $lecturer = Lecturer::factory()->create();

        $response = $this->put(route('class-meetings.update', $classMeeting), [
            'meet_no' => $meet_no,
            'class_id' => $class->id,
            'course_plan_detail_id' => $course_plan_detail->id,
            'class_lecturer_id' => $class_lecturer->id,
            'material_real' => $material_real,
            'assessment_real' => $assessment_real,
            'method' => $method,
            'class_course_id' => $class_course->id,
            'lecturer_id' => $lecturer->id,
        ]);

        $classMeeting->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($meet_no, $classMeeting->meet_no);
        $this->assertEquals($class->id, $classMeeting->class_id);
        $this->assertEquals($course_plan_detail->id, $classMeeting->course_plan_detail_id);
        $this->assertEquals($class_lecturer->id, $classMeeting->class_lecturer_id);
        $this->assertEquals($material_real, $classMeeting->material_real);
        $this->assertEquals($assessment_real, $classMeeting->assessment_real);
        $this->assertEquals($method, $classMeeting->method);
        $this->assertEquals($class_course->id, $classMeeting->class_course_id);
        $this->assertEquals($lecturer->id, $classMeeting->lecturer_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $classMeeting = ClassMeeting::factory()->create();

        $response = $this->delete(route('class-meetings.destroy', $classMeeting));

        $response->assertNoContent();

        $this->assertModelMissing($classMeeting);
    }
}
