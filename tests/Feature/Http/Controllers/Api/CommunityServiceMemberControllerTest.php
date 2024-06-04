<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CommunityService;
use App\Models\CommunityServiceMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CommunityServiceMemberController
 */
final class CommunityServiceMemberControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $communityServiceMembers = CommunityServiceMember::factory()->count(3)->create();

        $response = $this->get(route('community-service-members.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CommunityServiceMemberController::class,
            'store',
            \App\Http\Requests\CommunityServiceMemberStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $user = User::factory()->create();
        $community_service = CommunityService::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('community-service-members.store'), [
            'user_id' => $user->id,
            'community_service_id' => $community_service->id,
            'position' => $position,
        ]);

        $communityServiceMembers = CommunityServiceMember::query()
            ->where('user_id', $user->id)
            ->where('community_service_id', $community_service->id)
            ->where('position', $position)
            ->get();
        $this->assertCount(1, $communityServiceMembers);
        $communityServiceMember = $communityServiceMembers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $communityServiceMember = CommunityServiceMember::factory()->create();

        $response = $this->get(route('community-service-members.show', $communityServiceMember));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CommunityServiceMemberController::class,
            'update',
            \App\Http\Requests\CommunityServiceMemberUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $communityServiceMember = CommunityServiceMember::factory()->create();
        $user = User::factory()->create();
        $community_service = CommunityService::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('community-service-members.update', $communityServiceMember), [
            'user_id' => $user->id,
            'community_service_id' => $community_service->id,
            'position' => $position,
        ]);

        $communityServiceMember->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($user->id, $communityServiceMember->user_id);
        $this->assertEquals($community_service->id, $communityServiceMember->community_service_id);
        $this->assertEquals($position, $communityServiceMember->position);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $communityServiceMember = CommunityServiceMember::factory()->create();

        $response = $this->delete(route('community-service-members.destroy', $communityServiceMember));

        $response->assertNoContent();

        $this->assertModelMissing($communityServiceMember);
    }
}
