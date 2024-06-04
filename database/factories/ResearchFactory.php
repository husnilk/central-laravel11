<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Research;
use App\Models\ResearchSchema;

class ResearchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Research::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'research_schema_id' => ResearchSchema::factory(),
            'start_at' => $this->faker->numberBetween(-10000, 10000),
            'fund_amount' => $this->faker->numberBetween(-10000, 10000),
            'proposal_file' => $this->faker->word(),
            'report_file' => $this->faker->word(),
        ];
    }
}
