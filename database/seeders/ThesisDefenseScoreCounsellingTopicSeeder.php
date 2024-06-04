<?php

namespace Database\Seeders;

use App\Models\ThesisDefenseScoreCounsellingTopic;
use Illuminate\Database\Seeder;

class ThesisDefenseScoreCounsellingTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisDefenseScoreCounsellingTopic::factory()->count(5)->create();
    }
}
