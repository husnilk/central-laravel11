<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ThesisRubric;
use App\Models\ThesisRubricDetail;

class ThesisRubricDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisRubricDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_rubric_id' => ThesisRubric::factory(),
            'description' => $this->faker->text(),
            'percentage' => $this->faker->randomFloat(0, 0, 9999999999.),
        ];
    }
}
