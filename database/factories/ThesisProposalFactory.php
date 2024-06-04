<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Room;
use App\Models\Thesis;
use App\Models\ThesisProposal;
use App\Models\User;

class ThesisProposalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisProposal::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_id' => Thesis::factory(),
            'datetime' => $this->faker->dateTime(),
            'room_id' => Room::factory(),
            'grade' => $this->faker->word(),
            'graded_by' => User::factory(),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'file_proposal' => $this->faker->word(),
            'user_id' => User::factory(),
        ];
    }
}
