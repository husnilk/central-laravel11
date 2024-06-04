<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Period;

class PeriodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Period::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'year' => $this->faker->numberBetween(-10000, 10000),
            'semester' => $this->faker->numberBetween(-10000, 10000),
            'active' => $this->faker->boolean(),
        ];
    }
}
