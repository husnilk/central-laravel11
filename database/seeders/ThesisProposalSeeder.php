<?php

namespace Database\Seeders;

use App\Models\ThesisProposal;
use Illuminate\Database\Seeder;

class ThesisProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisProposal::factory()->count(5)->create();
    }
}
