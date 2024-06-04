<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\ThesisProposal;
use App\Models\ThesisProposalAudience;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisProposalAudienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisProposalAudience::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'thesis_proposal_id' => ThesisProposal::factory(),
        ];
    }
}
