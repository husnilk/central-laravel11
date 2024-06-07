<?php

namespace Database\Seeders;

use App\Models\Internship;
use App\Models\InternshipCompany;
use App\Models\InternshipProposal;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PmpInternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::where('year', 2021)
            ->get();

        InternshipProposal::factory()->count(20)->create();
        $proposals = InternshipProposal::all();

        $counter = 0;
        foreach ($proposals as $proposal) {
            for ($i = 0; $i < 5; $i++) {
                if ($students->count() > $counter) {
                    $internship = Internship::factory()
                        ->hasLogs(10)
                        ->create([
                            'internship_proposal_id' => $proposal->id,
                            'student_id' => $students[$counter]->id,
                        ]);
                    $counter++;
                }
            }
        }
    }
}
