<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CourseEnrollment;
use App\Models\Lecturer;
use App\Models\Period;
use App\Models\Student;

class CourseEnrollmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseEnrollment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'period_id' => Period::factory(),
            'counselor_id' => Lecturer::factory(),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'mid_term_passcode' => $this->faker->word(),
            'final_term_passcode' => $this->faker->word(),
            'registered_at' => $this->faker->date(),
            'gpa' => $this->faker->randomFloat(2, 0, 999999.99),
        ];
    }
}
