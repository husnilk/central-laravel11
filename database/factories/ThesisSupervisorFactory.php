<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisSupervisorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisSupervisor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_id' => Thesis::factory(),
            'lecturer_id' => Lecturer::factory(),
            'position' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'created_by' => User::factory(),
        ];
    }
}
