<?php

namespace Database\Factories;

use App\Models\ResearchSchema;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResearchSchemaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ResearchSchema::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
