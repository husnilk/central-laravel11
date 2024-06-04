<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AssessmentCriteria;
use App\Models\AssessmentRubric;

class AssessmentRubricFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssessmentRubric::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'assessment_criteria_id' => AssessmentCriteria::factory(),
            'rubric' => $this->faker->word(),
            'grade' => $this->faker->randomFloat(2, 0, 999999.99),
        ];
    }
}
