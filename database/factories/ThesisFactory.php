<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisTopic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thesis::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'topic_id' => ThesisTopic::factory(),
            'student_id' => Student::factory(),
            'title' => fake()->sentence(4),
            'abstract' => fake()->text(),
            'start_at' => fake()->date(),
            'status' => fake()->numberBetween(0, 5),
            'grade' => fake()->randomNumber(['A', 'B', 'C', 'D', 'E']),
            'grade_by' => fake()->randomNumber(),
            'created_by' => User::factory(),
        ];
    }
}
