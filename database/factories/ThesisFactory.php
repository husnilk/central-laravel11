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
            'title' => $this->faker->sentence(4),
            'abstract' => $this->faker->text(),
            'start_at' => $this->faker->date(),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'grade' => $this->faker->word(),
            'grade_by' => $this->faker->randomNumber(),
            'created_by' => User::factory(),
            'thesis_topic_id' => ThesisTopic::factory(),
            'user_id' => User::factory(),
        ];
    }
}
