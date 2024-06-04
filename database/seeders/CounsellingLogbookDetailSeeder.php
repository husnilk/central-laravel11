<?php

namespace Database\Seeders;

use App\Models\CounsellingLogbookDetail;
use Illuminate\Database\Seeder;

class CounsellingLogbookDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CounsellingLogbookDetail::factory()->count(5)->create();
    }
}
