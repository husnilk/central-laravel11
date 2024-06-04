<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CoursePlan;
use App\Models\CoursePlanLo;
use App\Models\CurriculumIndicator;

class CoursePlanLoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlanLo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_plan_id' => CoursePlan::factory(),
            'curriculum_indicator_id' => CurriculumIndicator::factory(),
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
        ];
    }
}
