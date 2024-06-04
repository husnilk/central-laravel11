<?php

namespace Database\Factories;

use App\Models\CurriculumIndicator;
use App\Models\CurriculumPlo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumIndicatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurriculumIndicator::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'curriculum_plo_id' => CurriculumPlo::factory(),
            'code' => $this->faker->word(),
            'indicator' => $this->faker->word(),
            'min_grade' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
