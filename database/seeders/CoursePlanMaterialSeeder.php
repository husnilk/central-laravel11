<?php

namespace Database\Seeders;

use App\Models\CoursePlanMaterial;
use Illuminate\Database\Seeder;

class CoursePlanMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlanMaterial::factory()->count(5)->create();
    }
}
