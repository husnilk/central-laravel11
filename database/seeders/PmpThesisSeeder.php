<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisDefense;
use App\Models\ThesisDefenseExaminer;
use App\Models\ThesisRubric;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarReviewer;
use App\Models\ThesisSupervisor;
use App\Models\ThesisTopic;
use Illuminate\Database\Seeder;

class PmpThesisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rubric = ThesisRubric::factory()->create();
        $topics = ThesisTopic::factory()
            ->count(3)
            ->create();

        $students = Student::where('year', 2020)->get();
        $lecturers = Lecturer::all();
        $lecturer_ids = $lecturers->pluck('id', 'id')->toArray();
        $topic_ids = $topics->pluck('id', 'id')->toArray();
        $room_ids = Room::all()->pluck('id', 'id')->toArray();

        foreach ($students as $student) {
            $thesis = Thesis::factory()
                ->hasLogs(5)
                ->create([
                    'student_id' => $student->id,
                    'topic_id' => array_rand($topic_ids),
                    'created_by' => $student->id,
                ]);
            $supervisor = ThesisSupervisor::create([
                'thesis_id' => $thesis->id,
                'lecturer_id' => array_rand($lecturer_ids),
                'created_by' => $student->id,
            ]);
            $seminar = ThesisSeminar::factory()
                ->create([
                    'thesis_id' => $thesis->id,
                    'room_id' => array_rand($room_ids),
                ]);
            $reviewers = ThesisSeminarReviewer::create([
                'thesis_seminar_id' => $seminar->id,
                'reviewer_id' => array_rand($lecturer_ids),
            ]);
            $reviewers = ThesisSeminarReviewer::create([
                'thesis_seminar_id' => $seminar->id,
                'reviewer_id' => array_rand($lecturer_ids),
            ]);
            $defense = ThesisDefense::factory()
                ->create([
                    'thesis_id' => $thesis->id,
                    'thesis_rubric_id' => $rubric->id,
                    'room_id' => array_rand($room_ids)
                ]);
            $examiners = ThesisDefenseExaminer::create([
                'thesis_defense_id' => $defense->id,
                'examiner_id' => array_rand($lecturer_ids),
            ]);
        }

    }
}
