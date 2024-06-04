<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;

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
