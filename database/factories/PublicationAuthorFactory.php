<?php

namespace Database\Factories;

use App\Models\Publication;
use App\Models\PublicationAuthor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationAuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublicationAuthor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'publication_id' => Publication::factory(),
            'user_id' => User::factory(),
            'position' => $this->faker->numberBetween(-10000, 10000),
            'corresponding' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
