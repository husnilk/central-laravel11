<?php

namespace Database\Seeders;

use App\Models\CounsellingLogbook;
use Illuminate\Database\Seeder;

class CounsellingLogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CounsellingLogbook::factory()->count(5)->create();
    }
}
