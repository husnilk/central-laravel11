<?php

namespace Database\Factories;

use App\Models\CounsellingLogbook;
use App\Models\CounsellingLogbookDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CounsellingLogbookDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CounsellingLogbookDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'no' => $this->faker->numberBetween(-10000, 10000),
            'counselling_logbook_id' => CounsellingLogbook::factory(),
            'user_id' => User::factory(),
            'description' => $this->faker->text(),
        ];
    }
}
