<?php

namespace Database\Factories;

use App\Models\InternshipCompany;
use App\Models\InternshipProposal;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipProposalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InternshipProposal::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'company_id' => InternshipCompany::factory(),
            'type' => $this->faker->randomElement([1, 2]),
            'title' => $this->faker->sentence(4),
            'job_desc' => $this->faker->text(),
            'start_at' => $this->faker->date(),
            'end_at' => $this->faker->date(),
            'status' => $this->faker->randomElement(['draft', 'open']),
            'note' => $this->faker->text(),
            'active' => $this->faker->randomElement([0, 1]),
            'response_letter' => $this->faker->word(),
            'background' => $this->faker->text(),
        ];
    }
}
