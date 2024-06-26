<?php

namespace Database\Factories;

use App\Models\ThesisTopic;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisTopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisTopic::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
        ];
    }
}
