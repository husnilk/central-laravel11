<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CoursePlan;
use App\Models\CoursePlanReference;

class CoursePlanReferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanReference::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_id' => CoursePlan::factory(),
            'title' => $this->faker->sentence(4),
            'author' => $this->faker->word(),
            'publisher' => $this->faker->word(),
            'year' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->numberBetween(-10000, 10000),
            'primary' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
