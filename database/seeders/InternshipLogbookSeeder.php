<?php

namespace Database\Seeders;

use App\Models\InternshipLogbook;
use Illuminate\Database\Seeder;

class InternshipLogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InternshipLogbook::factory()->count(5)->create();
    }
}
