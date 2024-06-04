<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CoursePlan;
use App\Models\CoursePlanDetail;
use App\Models\CoursePlanLo;

class CoursePlanDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_id' => CoursePlan::factory(),
            'week' => $this->faker->numberBetween(-10000, 10000),
            'course_plan_lo_id' => CoursePlanLo::factory(),
            'grade_indicator' => $this->faker->text(),
            'grade_criteria' => $this->faker->text(),
            'media' => $this->faker->text(),
            'material' => $this->faker->text(),
            'reference' => $this->faker->text(),
            'method' => $this->faker->word(),
            'activity' => $this->faker->numberBetween(-10000, 10000),
            'est_time' => $this->faker->numberBetween(-10000, 10000),
            'student_activity' => $this->faker->text(),
        ];
    }
}
