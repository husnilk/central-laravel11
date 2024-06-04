<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->userName(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'type' => fake()->randomElement([1, 2, 3]),
            'active' => 1,
            'avatar' => fake()->imageUrl(),
            'profile_photo' => fake()->imageUrl(),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): static
    {
        return $this->state([
            'username' => 'admin',
            'name' => 'Super Admin',
            'email' => 'admin@central.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'type' => 0,
            'active' => 1,
            'avatar' => null,
        ]);
    }

    public function student(): Factory|UserFactory
    {
        return $this->state([
            'type' => User::STUDENT,
            'username' => $this->faker->numerify('S#####'),
        ]);
    }

    public function lecturer(): Factory|UserFactory
    {
        return $this->state([
            'type' => User::LECTURER,
            'username' => $this->faker->numerify('L####'),
        ]);
    }

    public function staff(): Factory|UserFactory
    {
        return $this->state([
            'type' => User::STAFF,
            'username' => $this->faker->numerify('E####'),
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
