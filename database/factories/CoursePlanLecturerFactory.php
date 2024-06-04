<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CoursePlan;
use App\Models\CoursePlanLecturer;
use App\Models\Lecturer;

class CoursePlanLecturerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanLecturer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_id' => CoursePlan::factory(),
            'lecturer_id' => Lecturer::factory(),
            'creator' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
