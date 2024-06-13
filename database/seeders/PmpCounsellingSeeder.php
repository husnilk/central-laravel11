<?php

namespace Database\Seeders;

use App\Models\CounsellingLogbook;
use App\Models\CounsellingTopic;
use App\Models\Period;
use App\Models\Student;
use Illuminate\Database\Seeder;

class PmpCounsellingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $period = Period::getActive()->first();

        $students = Student::where('year', 2021)->get();
        $topics = CounsellingTopic::factory()
            ->count(15)
            ->create();
        $arrTopics = $topics->pluck('id', 'id')->toArray();

        foreach ($students as $student) {
            CounsellingLogbook::factory()
                ->hasDetails(15, ['user_id' => $student->id])
                ->create([
                    'student_id' => $student->id,
                    'counsellor_id' => $student->counselor_id,
                    'counselling_topic_id' => array_rand($arrTopics),
                    'period_id' => $period->id,
                ]);
        }
    }
}
