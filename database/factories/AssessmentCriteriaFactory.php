<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AssessmentCriteria;
use App\Models\AssessmentDetail;

class AssessmentCriteriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssessmentCriteria::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'assessment_detail_id' => AssessmentDetail::factory(),
            'criteria' => $this->faker->word(),
            'method' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
