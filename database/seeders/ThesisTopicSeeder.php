<?php

namespace Database\Seeders;

use App\Models\ThesisTopic;
use Illuminate\Database\Seeder;

class ThesisTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisTopic::factory()->count(5)->create();
    }
}
