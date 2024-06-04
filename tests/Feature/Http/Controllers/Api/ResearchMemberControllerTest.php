<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Research;
use App\Models\ResearchMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ResearchMemberController
 */
final class ResearchMemberControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $researchMembers = ResearchMember::factory()->count(3)->create();

        $response = $this->get(route('research-members.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ResearchMemberController::class,
            'store',
            \App\Http\Requests\ResearchMemberStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $user = User::factory()->create();
        $research = Research::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('research-members.store'), [
            'user_id' => $user->id,
            'research_id' => $research->id,
            'position' => $position,
        ]);

        $researchMembers = ResearchMember::query()
            ->where('user_id', $user->id)
            ->where('research_id', $research->id)
            ->where('position', $position)
            ->get();
        $this->assertCount(1, $researchMembers);
        $researchMember = $researchMembers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $researchMember = ResearchMember::factory()->create();

        $response = $this->get(route('research-members.show', $researchMember));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ResearchMemberController::class,
            'update',
            \App\Http\Requests\ResearchMemberUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $researchMember = ResearchMember::factory()->create();
        $user = User::factory()->create();
        $research = Research::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('research-members.update', $researchMember), [
            'user_id' => $user->id,
            'research_id' => $research->id,
            'position' => $position,
        ]);

        $researchMember->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $researchMember->user_id);
        $this->assertEquals($research->id, $researchMember->research_id);
        $this->assertEquals($position, $researchMember->position);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $researchMember = ResearchMember::factory()->create();

        $response = $this->delete(route('research-members.destroy', $researchMember));

        $response->assertNoContent();

        $this->assertModelMissing($researchMember);
    }
}
