<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Room;
use App\Models\Thesis;
use App\Models\ThesisSeminar;

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
            'registered_at' => $this->faker->dateTime(),
            'method' => $this->faker->numberBetween(-10000, 10000),
            'seminar_at' => $this->faker->dateTime(),
            'room_id' => Room::factory(),
            'online_url' => $this->faker->text(),
            'file_report' => $this->faker->word(),
            'file_slide' => $this->faker->word(),
            'file_journal' => $this->faker->word(),
            'file_attendance' => $this->faker->word(),
            'recommendation' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text(),
        ];
    }
}
