<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Class;
use App\Models\ClassCourse;
use App\Models\ClassSchedule;
use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ClassScheduleController
 */
final class ClassScheduleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $classSchedules = ClassSchedule::factory()->count(3)->create();

        $response = $this->get(route('class-schedules.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassScheduleController::class,
            'store',
            \App\Http\Requests\ClassScheduleStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $class = Class::factory()->create();
        $room = Room::factory()->create();
        $weekday = $this->faker->numberBetween(-10000, 10000);
        $start_at = $this->faker->time();
        $end_at = $this->faker->time();
        $class_course = ClassCourse::factory()->create();

        $response = $this->post(route('class-schedules.store'), [
            'class_id' => $class->id,
            'room_id' => $room->id,
            'weekday' => $weekday,
            'start_at' => $start_at,
            'end_at' => $end_at,
            'class_course_id' => $class_course->id,
        ]);

        $classSchedules = ClassSchedule::query()
            ->where('class_id', $class->id)
            ->where('room_id', $room->id)
            ->where('weekday', $weekday)
            ->where('start_at', $start_at)
            ->where('end_at', $end_at)
            ->where('class_course_id', $class_course->id)
            ->get();
        $this->assertCount(1, $classSchedules);
        $classSchedule = $classSchedules->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $classSchedule = ClassSchedule::factory()->create();

        $response = $this->get(route('class-schedules.show', $classSchedule));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ClassScheduleController::class,
            'update',
            \App\Http\Requests\ClassScheduleUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $classSchedule = ClassSchedule::factory()->create();
        $class = Class::factory()->create();
        $room = Room::factory()->create();
        $weekday = $this->faker->numberBetween(-10000, 10000);
        $start_at = $this->faker->time();
        $end_at = $this->faker->time();
        $class_course = ClassCourse::factory()->create();

        $response = $this->put(route('class-schedules.update', $classSchedule), [
            'class_id' => $class->id,
            'room_id' => $room->id,
            'weekday' => $weekday,
            'start_at' => $start_at,
            'end_at' => $end_at,
            'class_course_id' => $class_course->id,
        ]);

        $classSchedule->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($class->id, $classSchedule->class_id);
        $this->assertEquals($room->id, $classSchedule->room_id);
        $this->assertEquals($weekday, $classSchedule->weekday);
        $this->assertEquals($start_at, $classSchedule->start_at);
        $this->assertEquals($end_at, $classSchedule->end_at);
        $this->assertEquals($class_course->id, $classSchedule->class_course_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $classSchedule = ClassSchedule::factory()->create();

        $response = $this->delete(route('class-schedules.destroy', $classSchedule));

        $response->assertNoContent();

        $this->assertModelMissing($classSchedule);
    }
}
