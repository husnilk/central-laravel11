<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\CoursePlan;
use App\Models\Period;

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
            'course_credits' => $this->faker->numberBetween(-10000, 10000),
            'course_semester' => $this->faker->numberBetween(-10000, 10000),
            'meeting_nonconformity' => $this->faker->text(),
            'meeting_verified' => $this->faker->boolean(),
        ];
    }
}
