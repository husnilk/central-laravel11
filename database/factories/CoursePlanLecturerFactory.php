<?php

namespace Database\Factories;

use App\Models\CoursePlan;
use App\Models\CoursePlanLecturer;
use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

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
