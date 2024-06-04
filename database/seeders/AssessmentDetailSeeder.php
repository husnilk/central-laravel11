<?php

namespace Database\Seeders;

use App\Models\AssessmentDetail;
use Illuminate\Database\Seeder;

class AssessmentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssessmentDetail::factory()->count(5)->create();
    }
}
