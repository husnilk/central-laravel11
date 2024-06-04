<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Internship;
use App\Models\InternshipProposal;
use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Student;

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
            'status' => $this->faker->randomElement(["accepted","rejected","ongoing","seminar","administration","finished","cancelled"]),
            'start_at' => $this->faker->date(),
            'end_at' => $this->faker->date(),
            'report_title' => $this->faker->text(),
            'seminar_date' => $this->faker->date(),
            'seminar_room_id' => Room::factory(),
            'link_seminar' => $this->faker->word(),
            'seminar_deadline' => $this->faker->date(),
            'attendees_list' => $this->faker->word(),
            'internship_score' => $this->faker->word(),
            'activity_report' => $this->faker->word(),
            'news_event' => $this->faker->word(),
            'work_report' => $this->faker->word(),
            'certificate' => $this->faker->word(),
            'report_receipt' => $this->faker->word(),
            'grade' => $this->faker->word(),
            'lecturer_id' => Lecturer::factory(),
        ];
    }
}
