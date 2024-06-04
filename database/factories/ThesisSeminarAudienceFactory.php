<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisSeminarAudienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisSeminarAudience::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_seminar_id' => ThesisSeminar::factory(),
            'student_id' => Student::factory(),
        ];
    }
}
