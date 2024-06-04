<?php

namespace Database\Factories;

use App\Models\Curriculum;
use App\Models\CurriculumPeo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumPeoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurriculumPeo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'curriculum_id' => Curriculum::factory(),
            'code' => $this->faker->word(),
            'profile' => $this->faker->text(),
            'description' => $this->faker->text(),
        ];
    }
}
