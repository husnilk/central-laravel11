<?php

namespace Database\Seeders;

use App\Models\ThesisSupervisor;
use Illuminate\Database\Seeder;

class ThesisSupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisSupervisor::factory()->count(5)->create();
    }
}
