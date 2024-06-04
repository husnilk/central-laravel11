<?php

namespace Database\Factories;

use App\Models\InternshipCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InternshipCompany::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->text(),
        ];
    }
}
