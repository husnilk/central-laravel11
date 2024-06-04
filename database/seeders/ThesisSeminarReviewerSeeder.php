<?php

namespace Database\Seeders;

use App\Models\ThesisSeminarReviewer;
use Illuminate\Database\Seeder;

class ThesisSeminarReviewerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisSeminarReviewer::factory()->count(5)->create();
    }
}
