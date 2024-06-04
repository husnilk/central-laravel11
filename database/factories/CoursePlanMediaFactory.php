<?php

namespace Database\Factories;

use App\Models\CoursePlan;
use App\Models\CoursePlanMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursePlanMediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanMedia::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_id' => CoursePlan::factory(),
            'type' => $this->faker->numberBetween(-10000, 10000),
            'media' => $this->faker->word(),
        ];
    }
}
