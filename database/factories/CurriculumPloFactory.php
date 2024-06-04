<?php

namespace Database\Factories;

use App\Models\Curriculum;
use App\Models\CurriculumPlo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumPloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurriculumPlo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'curriculum_id' => Curriculum::factory(),
            'code' => $this->faker->word(),
            'outcome' => $this->faker->text(),
            'description' => $this->faker->text(),
            'min_grade' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
