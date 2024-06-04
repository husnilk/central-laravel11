<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\CoursePlan;
use App\Models\CoursePlanRequirement;

class CoursePlanRequirementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanRequirement::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_id' => CoursePlan::factory(),
            'req_course_id' => Course::factory(),
            'req_level' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
