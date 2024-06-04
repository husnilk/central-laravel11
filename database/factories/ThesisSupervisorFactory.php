<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Lecturer;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use App\Models\User;

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
