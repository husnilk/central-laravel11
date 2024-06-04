<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Student;
use App\Models\ThesisProposal;
use App\Models\ThesisProposalAudience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisProposalAudienceController
 */
final class ThesisProposalAudienceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisProposalAudiences = ThesisProposalAudience::factory()->count(3)->create();

        $response = $this->get(route('thesis-proposal-audiences.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisProposalAudienceController::class,
            'store',
            \App\Http\Requests\ThesisProposalAudienceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $student = Student::factory()->create();
        $thesis_proposal = ThesisProposal::factory()->create();

        $response = $this->post(route('thesis-proposal-audiences.store'), [
            'student_id' => $student->id,
            'thesis_proposal_id' => $thesis_proposal->id,
        ]);

        $thesisProposalAudiences = ThesisProposalAudience::query()
            ->where('student_id', $student->id)
            ->where('thesis_proposal_id', $thesis_proposal->id)
            ->get();
        $this->assertCount(1, $thesisProposalAudiences);
        $thesisProposalAudience = $thesisProposalAudiences->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisProposalAudience = ThesisProposalAudience::factory()->create();

        $response = $this->get(route('thesis-proposal-audiences.show', $thesisProposalAudience));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisProposalAudienceController::class,
            'update',
            \App\Http\Requests\ThesisProposalAudienceUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisProposalAudience = ThesisProposalAudience::factory()->create();
        $student = Student::factory()->create();
        $thesis_proposal = ThesisProposal::factory()->create();

        $response = $this->put(route('thesis-proposal-audiences.update', $thesisProposalAudience), [
            'student_id' => $student->id,
            'thesis_proposal_id' => $thesis_proposal->id,
        ]);

        $thesisProposalAudience->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($student->id, $thesisProposalAudience->student_id);
        $this->assertEquals($thesis_proposal->id, $thesisProposalAudience->thesis_proposal_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisProposalAudience = ThesisProposalAudience::factory()->create();

        $response = $this->delete(route('thesis-proposal-audiences.destroy', $thesisProposalAudience));

        $response->assertNoContent();

        $this->assertModelMissing($thesisProposalAudience);
    }
}
