<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClassCourse;
use App\Models\ClassLecturer;
use App\Models\Lecturer;

class ClassLecturerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassLecturer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'class_id' => ClassCourse::factory(),
            'lecturer_id' => Lecturer::factory(),
            'position' => $this->faker->numberBetween(-10000, 10000),
            'grading' => $this->faker->numberBetween(-10000, 10000),
            'class_course_id' => ClassCourse::factory(),
        ];
    }
}
