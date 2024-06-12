<?php

namespace Database\Factories;

use App\Models\CounsellingCategory;
use App\Models\CounsellingLogbook;
use App\Models\CounsellingTopic;
use App\Models\Lecturer;
use App\Models\Period;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class CounsellingLogbookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CounsellingLogbook::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'counsellor_id' => Lecturer::factory(),
            'counselling_topic_id' => CounsellingTopic::factory(),
            'period_id' => Period::factory(),
            'date' => $this->faker->date(),
            'status' => $this->faker->numberBetween(0, 1),
            'file' => $this->faker->word(),
        ];
    }
}
