<?php

namespace Database\Seeders;

use App\Models\ResearchSchema;
use Illuminate\Database\Seeder;

class ResearchSchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ResearchSchema::factory()->count(5)->create();
    }
}
