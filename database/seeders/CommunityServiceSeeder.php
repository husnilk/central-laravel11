<?php

namespace Database\Seeders;

use App\Models\CommunityService;
use Illuminate\Database\Seeder;

class CommunityServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommunityService::factory()->count(5)->create();
    }
}
