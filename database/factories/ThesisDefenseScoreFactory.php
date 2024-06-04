<?php

namespace Database\Factories;

use App\Models\ThesisDefenseExaminer;
use App\Models\ThesisDefenseScore;
use App\Models\ThesisRubricDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisDefenseScoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisDefenseScore::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_defense_examiner_id' => ThesisDefenseExaminer::factory(),
            'thesis_rubric_detail_id' => ThesisRubricDetail::factory(),
            'score' => $this->faker->randomFloat(0, 0, 9999999999.),
            'notes' => $this->faker->text(),
        ];
    }
}
