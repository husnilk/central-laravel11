<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Research;
use App\Models\ResearchMember;
use App\Models\User;

class ResearchMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ResearchMember::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'research_id' => Research::factory(),
            'position' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
