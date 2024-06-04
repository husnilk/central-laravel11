<?php

namespace Database\Factories;

use App\Models\CoursePlan;
use App\Models\CoursePlanAssessment;
use Illuminate\Database\Eloquent\Factories\Factory;

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
