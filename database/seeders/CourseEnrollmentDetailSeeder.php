<?php

namespace Database\Seeders;

use App\Models\CourseEnrollmentDetail;
use Illuminate\Database\Seeder;

class CourseEnrollmentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseEnrollmentDetail::factory()->count(5)->create();
    }
}
