<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => User::factory(),
            'nik' => $this->faker->numerify('137107##############'),
            'nim' => $this->faker->numerify('20########'),
            'name' => $this->faker->name(),
            'year' => $this->faker->year(),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'birthday' => $this->faker->date(),
            'birthplace' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'department_id' => Department::factory(),
            'photo' => $this->faker->imageUrl(),
            'marital_status' => $this->faker->numberBetween(0, 2),
            'religion' => $this->faker->numberBetween(1, 7),
            'status' => $this->faker->numberBetween(1, 2),
            'counselor_id' => Lecturer::factory(),
        ];
    }
}
