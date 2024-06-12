<?php

namespace Database\Factories;

use App\Models\ThesisRubric;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisRubricFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisRubric::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'active' => fake()->numberBetween(0, 1),
        ];
    }
}
