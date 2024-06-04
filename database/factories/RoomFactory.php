<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Building;
use App\Models\Room;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'building_id' => Building::factory(),
            'name' => $this->faker->name(),
            'floor' => $this->faker->numberBetween(1, 6),
            'number' => $this->faker->numberBetween(1, 64),
            'capacity' => $this->faker->numberBetween(0, 1000),
            'size' => $this->faker->numberBetween(1, 100),
            'location' => null,
            'public' => $this->faker->numberBetween(1, 2),
            'status' => $this->faker->numberBetween(1, 2),
            'availability' => $this->faker->numberBetween(1, 2),
        ];
    }
}
