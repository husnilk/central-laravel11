<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'curriculum_id' => Curriculum::factory(),
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
            'alias_name' => $this->faker->word(),
            'credit' => $this->faker->numberBetween(-10000, 10000),
            'semester' => $this->faker->numberBetween(-10000, 10000),
            'mandatory' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text(),
        ];
    }
}
