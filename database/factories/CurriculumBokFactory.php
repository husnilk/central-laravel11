<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Curriculum;
use App\Models\CurriculumBok;

class CurriculumBokFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurriculumBok::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'curriculum_id' => Curriculum::factory(),
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
        ];
    }
}
