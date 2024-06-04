<?php

namespace Database\Factories;

use App\Models\AssessmentDetail;
use App\Models\CoursePlanAssessment;
use App\Models\CoursePlanLo;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssessmentDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_assessment_id' => CoursePlanAssessment::factory(),
            'course_plan_lo_id' => CoursePlanLo::factory(),
            'percentage' => $this->faker->randomFloat(2, 0, 999999.99),
        ];
    }
}
