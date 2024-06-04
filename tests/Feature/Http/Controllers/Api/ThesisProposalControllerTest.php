<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\GradedBy;
use App\Models\Thesis;
use App\Models\ThesisProposal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisProposalController
 */
final class ThesisProposalControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisProposals = ThesisProposal::factory()->count(3)->create();

        $response = $this->get(route('thesis-proposals.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisProposalController::class,
            'store',
            \App\Http\Requests\ThesisProposalStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis = Thesis::factory()->create();
        $datetime = Carbon::parse($this->faker->dateTime());
        $graded_by = GradedBy::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $user = User::factory()->create();

        $response = $this->post(route('thesis-proposals.store'), [
            'thesis_id' => $thesis->id,
            'datetime' => $datetime->toDateTimeString(),
            'graded_by' => $graded_by->id,
            'status' => $status,
            'user_id' => $user->id,
        ]);

        $thesisProposals = ThesisProposal::query()
            ->where('thesis_id', $thesis->id)
            ->where('datetime', $datetime)
            ->where('graded_by', $graded_by->id)
            ->where('status', $status)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $thesisProposals);
        $thesisProposal = $thesisProposals->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisProposal = ThesisProposal::factory()->create();

        $response = $this->get(route('thesis-proposals.show', $thesisProposal));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisProposalController::class,
            'update',
            \App\Http\Requests\ThesisProposalUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisProposal = ThesisProposal::factory()->create();
        $thesis = Thesis::factory()->create();
        $datetime = Carbon::parse($this->faker->dateTime());
        $graded_by = GradedBy::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $user = User::factory()->create();

        $response = $this->put(route('thesis-proposals.update', $thesisProposal), [
            'thesis_id' => $thesis->id,
            'datetime' => $datetime->toDateTimeString(),
            'graded_by' => $graded_by->id,
            'status' => $status,
            'user_id' => $user->id,
        ]);

        $thesisProposal->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis->id, $thesisProposal->thesis_id);
        $this->assertEquals($datetime, $thesisProposal->datetime);
        $this->assertEquals($graded_by->id, $thesisProposal->graded_by);
        $this->assertEquals($status, $thesisProposal->status);
        $this->assertEquals($user->id, $thesisProposal->user_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisProposal = ThesisProposal::factory()->create();

        $response = $this->delete(route('thesis-proposals.destroy', $thesisProposal));

        $response->assertNoContent();

        $this->assertModelMissing($thesisProposal);
    }
}
