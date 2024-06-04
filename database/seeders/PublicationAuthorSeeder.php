<?php

namespace Database\Seeders;

use App\Models\PublicationAuthor;
use Illuminate\Database\Seeder;

class PublicationAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PublicationAuthor::factory()->count(5)->create();
    }
}
