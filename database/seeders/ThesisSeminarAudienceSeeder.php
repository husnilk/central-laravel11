<?php

namespace Database\Seeders;

use App\Models\ThesisSeminarAudience;
use Illuminate\Database\Seeder;

class ThesisSeminarAudienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisSeminarAudience::factory()->count(5)->create();
    }
}
