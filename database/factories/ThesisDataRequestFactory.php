<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisDataRequest;
use App\Models\ThesisSupervisor;

class ThesisDataRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisDataRequest::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'thesis_id' => Thesis::factory(),
            'supervisor_id' => ThesisSupervisor::factory(),
            'request_at' => $this->faker->dateTime(),
            'requested_data' => $this->faker->text(),
            'request_to_person' => $this->faker->text(),
            'request_to_position' => $this->faker->text(),
            'request_to_org' => $this->faker->text(),
            'request_to_address' => $this->faker->text(),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'student_id' => Student::factory(),
        ];
    }
}
