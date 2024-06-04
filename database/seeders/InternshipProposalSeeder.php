<?php

namespace Database\Seeders;

use App\Models\InternshipProposal;
use Illuminate\Database\Seeder;

class InternshipProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InternshipProposal::factory()->count(5)->create();
    }
}
