<?php

namespace Database\Factories;

use App\Models\CoursePlan;
use App\Models\CoursePlanMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursePlanMaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanMaterial::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_id' => CoursePlan::factory(),
            'topic' => $this->faker->word(),
        ];
    }
}
