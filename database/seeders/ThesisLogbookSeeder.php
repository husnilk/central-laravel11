<?php

namespace Database\Seeders;

use App\Models\ThesisLogbook;
use Illuminate\Database\Seeder;

class ThesisLogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisLogbook::factory()->count(5)->create();
    }
}
