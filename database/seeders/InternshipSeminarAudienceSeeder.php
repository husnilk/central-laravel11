<?php

namespace Database\Seeders;

use App\Models\InternshipSeminarAudience;
use Illuminate\Database\Seeder;

class InternshipSeminarAudienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InternshipSeminarAudience::factory()->count(5)->create();
    }
}
