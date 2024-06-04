<?php

namespace Database\Factories;

use App\Models\CurriculumBok;
use App\Models\CurriculumBokDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumBokDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurriculumBokDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'curriculum_bok_id' => CurriculumBok::factory(),
            'lo' => $this->faker->text(),
        ];
    }
}
