<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\CoursePlan;
use App\Models\Lecturer;

class CoursePlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CoursePlan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'rev' => $this->faker->numberBetween(-10000, 10000),
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
            'alias_name' => $this->faker->word(),
            'credit' => $this->faker->numberBetween(-10000, 10000),
            'semester' => $this->faker->numberBetween(-10000, 10000),
            'mandatory' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text(),
            'ilearn_url' => $this->faker->word(),
            'validated_by' => Lecturer::factory(),
            'validated_at' => $this->faker->dateTime(),
            'learning_strategy' => $this->faker->text(),
            'learning_management' => $this->faker->text(),
            'participant' => $this->faker->text(),
            'class_observation' => $this->faker->text(),
            'constraint' => $this->faker->text(),
            'improvement' => $this->faker->text(),
        ];
    }
}
