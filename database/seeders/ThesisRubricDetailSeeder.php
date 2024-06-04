<?php

namespace Database\Seeders;

use App\Models\ThesisRubricDetail;
use Illuminate\Database\Seeder;

class ThesisRubricDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisRubricDetail::factory()->count(5)->create();
    }
}
