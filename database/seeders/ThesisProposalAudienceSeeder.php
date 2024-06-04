<?php

namespace Database\Seeders;

use App\Models\ThesisProposalAudience;
use Illuminate\Database\Seeder;

class ThesisProposalAudienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThesisProposalAudience::factory()->count(5)->create();
    }
}
