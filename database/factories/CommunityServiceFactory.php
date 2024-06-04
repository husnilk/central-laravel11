<?php

namespace Database\Factories;

use App\Models\CommunityService;
use App\Models\CommunityServiceSchema;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommunityService::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'community_service_schema_id' => CommunityServiceSchema::factory(),
            'partner' => $this->faker->word(),
            'start_at' => $this->faker->numberBetween(-10000, 10000),
            'fund_amount' => $this->faker->numberBetween(-10000, 10000),
            'proposal_file' => $this->faker->word(),
            'report_file' => $this->faker->word(),
        ];
    }
}
