<?php

namespace Database\Seeders;

use App\Models\ResearchMember;
use Illuminate\Database\Seeder;

class ResearchMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResearchMember::factory()->count(5)->create();
    }
}
