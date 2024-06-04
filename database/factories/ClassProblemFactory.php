<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClassCourse;
use App\Models\ClassProblem;
use App\Models\CourseEnrollmentDetail;

class ClassProblemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassProblem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'class_course_id' => ClassCourse::factory(),
            'course_enrollment_detail_id' => CourseEnrollmentDetail::factory(),
            'problem' => $this->faker->text(),
            'solution' => $this->faker->text(),
        ];
    }
}
