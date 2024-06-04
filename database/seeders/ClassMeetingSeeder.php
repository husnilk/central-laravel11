<?php

namespace Database\Seeders;

use App\Models\ClassMeeting;
use Illuminate\Database\Seeder;

class ClassMeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassMeeting::factory()->count(5)->create();
    }
}
