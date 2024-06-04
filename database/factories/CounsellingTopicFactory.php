<?php

namespace Database\Factories;

use App\Models\CounsellingTopic;
use Illuminate\Database\Eloquent\Factories\Factory;

class CounsellingTopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CounsellingTopic::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
