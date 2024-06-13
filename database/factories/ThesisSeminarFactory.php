<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisSeminarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisSeminar::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_id' => Thesis::factory(),
            'registered_at' => fake()->dateTime(),
            'method' => fake()->numberBetween(-10000, 10000),
            'seminar_at' => fake()->dateTimeBetween('-3 years', '2 months'),
            'room_id' => Room::factory(),
            'online_url' => fake()->text(),
            'file_report' => fake()->word(),
            'file_slide' => fake()->word(),
            'file_journal' => fake()->word(),
            'file_attendance' => fake()->word(),
            'recommendation' => fake()->numberBetween(-10000, 10000),
            'status' => fake()->numberBetween(0, 5),
            'description' => fake()->text(),
        ];
    }
}
