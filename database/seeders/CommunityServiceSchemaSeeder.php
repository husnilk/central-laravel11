<?php

namespace Database\Seeders;

use App\Models\CommunityServiceSchema;
use Illuminate\Database\Seeder;

class CommunityServiceSchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommunityServiceSchema::factory()->count(5)->create();
    }
}
