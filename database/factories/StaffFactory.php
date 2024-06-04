<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Department;
use App\Models\Staff;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => User::factory(),
            'nik' => $this->faker->numerify('137107##############'),
            'name' => $this->faker->name(),
            'nip' => $this->faker->numerify('19##################'),
            'karpeg' => $this->faker->word(),
            'npwp' => $this->faker->word(),
            'gender' => $this->faker->randomElement(["M","F"]),
            'birthday' => $this->faker->date(),
            'birthplace' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'department_id' => Department::factory(),
            'photo' => $this->faker->imageUrl(),
            'marital_status' => $this->faker->numberBetween(0, 1),
            'religion' => $this->faker->numberBetween(1, 7),
            'association_type' => $this->faker->numberBetween(1, 2),
            'status' => $this->faker->numberBetween(1, 2),
        ];
    }
}
