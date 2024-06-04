<?php

namespace Database\Factories;

use App\Models\Internship;
use App\Models\InternshipSeminarAudience;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'role' => $this->faker->randomElement(['audience', 'moderator', 'questioner']),
            'question' => $this->faker->text(),
        ];
    }
}
