<?php

namespace Database\Factories;

use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\CoursePlan;
use App\Models\Period;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassCourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassCourse::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'period_id' => Period::factory(),
            'course_plan_id' => CoursePlan::factory(),
            'name' => $this->faker->name(),
            'course_code' => $this->faker->word(),
            'course_name' => $this->faker->word(),
            'course_credits' => $this->faker->numberBetween(2, 3),
            'course_semester' => $this->faker->numberBetween(1, 8),
            'meeting_nonconformity' => $this->faker->text(),
            'meeting_verified' => $this->faker->boolean(),
        ];
    }
}
