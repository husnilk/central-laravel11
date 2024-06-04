<?php

namespace Database\Factories;

use App\Models\CoursePlanDetail;
use App\Models\CoursePlanDetailActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursePlanDetailActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanDetailActivity::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_detail_id' => CoursePlanDetail::factory(),
            'activity' => $this->faker->numberBetween(-10000, 10000),
            'method' => $this->faker->word(),
            'est_time' => $this->faker->numberBetween(-10000, 10000),
            'student_activity' => $this->faker->text(),
        ];
    }
}
