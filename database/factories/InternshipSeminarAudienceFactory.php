<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Internship;
use App\Models\InternshipSeminarAudience;
use App\Models\Student;

class InternshipSeminarAudienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InternshipSeminarAudience::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'internship_id' => Internship::factory(),
            'student_id' => Student::factory(),
            'role' => $this->faker->randomElement(["audience","moderator","questioner"]),
            'question' => $this->faker->text(),
        ];
    }
}
