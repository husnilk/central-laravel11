<?php

namespace Database\Seeders;

use App\Models\ClassSchedule;
use Illuminate\Database\Seeder;

class ClassScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassSchedule::factory()->count(5)->create();
    }
}
