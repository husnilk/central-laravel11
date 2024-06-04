<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CoursePlan;
use App\Models\CoursePlanAssessment;

class CoursePlanAssessmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanAssessment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_id' => CoursePlan::factory(),
            'name' => $this->faker->name(),
            'percentage' => $this->faker->randomFloat(2, 0, 999999.99),
        ];
    }
}
