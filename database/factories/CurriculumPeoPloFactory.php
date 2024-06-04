<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CurriculumPeo;
use App\Models\CurriculumPeoPlo;
use App\Models\CurriculumPlo;

class CurriculumPeoPloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurriculumPeoPlo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'curriculum_peo_id' => CurriculumPeo::factory(),
            'curriculum_plo_id' => CurriculumPlo::factory(),
        ];
    }
}
