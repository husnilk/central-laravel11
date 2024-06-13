<?php

namespace Database\Factories;

use App\Models\Internship;
use App\Models\InternshipProposal;
use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Internship::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'internship_proposal_id' => InternshipProposal::factory(),
            'student_id' => Student::factory(),
            'advisor_id' => Lecturer::factory(),
            'status' => fake()->randomElement(['accepted', 'rejected', 'ongoing', 'seminar', 'administration', 'finished', 'cancelled']),
            'start_at' => fake()->date(),
            'end_at' => fake()->date(),
            'report_title' => fake()->text(),
            'seminar_date' => fake()->date(),
            'seminar_room_id' => Room::factory(),
            'link_seminar' => fake()->url(),
            'seminar_deadline' => fake()->date(),
            'attendees_list' => fake()->word(),
            'internship_score' => fake()->word(),
            'activity_report' => fake()->word(),
            'seminar_notes' => fake()->word(),
            'work_report' => fake()->word(),
            'certificate' => fake()->word(),
            'report_receipt' => fake()->word(),
            'grade' => fake()->randomElement(['A', 'B', 'C', 'D', 'E']),
        ];
    }
}
