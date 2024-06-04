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
            'file_report' => $this->faker->word(),
            'file_slide' => $this->faker->word(),
            'file_journal' => $this->faker->word(),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'registered_at' => $this->faker->dateTime(),
            'method' => $this->faker->numberBetween(-10000, 10000),
            'trial_at' => $this->faker->date(),
            'start_at' => $this->faker->time(),
            'end_at' => $this->faker->time(),
            'room_id' => Room::factory(),
            'online_url' => $this->faker->text(),
            'score' => $this->faker->randomFloat(0, 0, 9999999999.),
            'grade' => $this->faker->word(),
            'description' => $this->faker->text(),
        ];
    }
}
