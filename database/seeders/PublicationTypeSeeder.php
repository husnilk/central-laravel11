<?php

namespace Database\Seeders;

use App\Models\PublicationType;
use Illuminate\Database\Seeder;

class PublicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PublicationType::factory()->count(5)->create();
    }
}
