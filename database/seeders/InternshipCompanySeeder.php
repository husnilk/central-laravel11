<?php

namespace Database\Seeders;

use App\Models\InternshipCompany;
use Illuminate\Database\Seeder;

class InternshipCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InternshipCompany::factory()->count(5)->create();
    }
}
