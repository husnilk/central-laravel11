<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CommunityService;
use App\Models\CommunityServiceMember;
use App\Models\User;

class CommunityServiceMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommunityServiceMember::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'community_service_id' => CommunityService::factory(),
            'position' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
