<?php

namespace Database\Factories;

use App\Models\CommunityServiceSchema;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityServiceSchemaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommunityServiceSchema::class;

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
