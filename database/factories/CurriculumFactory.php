<?php

namespace Database\Factories;

use App\Models\Curriculum;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Curriculum::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'department_id' => Department::factory(),
            'year_start' => $this->faker->numberBetween(-10000, 10000),
            'year_end' => $this->faker->numberBetween(-10000, 10000),
            'active' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text(),
        ];
    }
}
