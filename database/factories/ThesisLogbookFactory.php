<?php

namespace Database\Factories;

use App\Models\Thesis;
use App\Models\ThesisLogbook;
use App\Models\ThesisSupervisor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisLogbookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisLogbook::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_id' => Thesis::factory(),
            'supervisor_id' => ThesisSupervisor::factory(),
            'date' => $this->faker->date(),
            'progress' => $this->faker->text(),
            'problem' => $this->faker->text(),
            'file_progress' => $this->faker->word(),
            'supervised_by' => ThesisSupervisor::factory(),
            'supervised_at' => $this->faker->dateTime(),
            'notes' => $this->faker->text(),
            'file_notes' => $this->faker->word(),
            'status' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
