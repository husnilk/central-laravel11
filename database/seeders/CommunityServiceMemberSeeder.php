<?php

namespace Database\Seeders;

use App\Models\CommunityServiceMember;
use Illuminate\Database\Seeder;

class CommunityServiceMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommunityServiceMember::factory()->count(5)->create();
    }
}
