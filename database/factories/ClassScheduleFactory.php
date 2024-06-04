<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClassCourse;
use App\Models\ClassSchedule;
use App\Models\Room;

class ClassScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassSchedule::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'class_id' => ClassCourse::factory(),
            'room_id' => Room::factory(),
            'weekday' => $this->faker->numberBetween(-10000, 10000),
            'start_at' => $this->faker->time(),
            'end_at' => $this->faker->time(),
            'class_course_id' => ClassCourse::factory(),
        ];
    }
}
