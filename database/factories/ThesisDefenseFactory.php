<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Thesis;
use App\Models\ThesisDefense;
use App\Models\ThesisRubric;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisDefenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisDefense::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_id' => Thesis::factory(),
            'thesis_rubric_id' => ThesisRubric::factory(),
            'file_report' => fake()->word(),
            'file_slide' => fake()->word(),
            'file_journal' => fake()->word(),
            'status' => fake()->numberBetween(-10000, 10000),
            'registered_at' => fake()->dateTime(),
            'method' => fake()->numberBetween(-10000, 10000),
            'trial_at' => fake()->date(),
            'start_at' => fake()->time(),
            'end_at' => fake()->time(),
            'room_id' => Room::factory(),
            'online_url' => fake()->text(),
            'score' => fake()->randomFloat(0, 0, 9999999999.),
            'grade' => fake()->word(),
            'description' => fake()->text(),
        ];
    }
}
