<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Internship;
use App\Models\InternshipLogbook;

class InternshipLogbookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InternshipLogbook::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'internship_id' => Internship::factory(),
            'date' => $this->faker->date(),
            'activities' => $this->faker->text(),
            'note' => $this->faker->text(),
        ];
    }
}
