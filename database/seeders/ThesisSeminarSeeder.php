<?php

namespace Database\Seeders;

use App\Models\ThesisSeminar;
use Illuminate\Database\Seeder;

class ThesisSeminarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisSeminar::factory()->count(5)->create();
    }
}
