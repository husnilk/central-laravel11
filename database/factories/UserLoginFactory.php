<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserLoginFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserLogin::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ip_address' => $this->faker->word(),
            'user_agent' => $this->faker->word(),
            'payload' => $this->faker->word(),
            'last_activity' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
