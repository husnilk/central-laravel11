<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CommunityService;
use App\Models\CommunityServiceSchema;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CommunityServiceController
 */
final class CommunityServiceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $communityServices = CommunityService::factory()->count(3)->create();

        $response = $this->get(route('community-services.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CommunityServiceController::class,
            'store',
            \App\Http\Requests\CommunityServiceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = $this->faker->sentence(4);
        $community_service_schema = CommunityServiceSchema::factory()->create();

        $response = $this->post(route('community-services.store'), [
            'title' => $title,
            'community_service_schema_id' => $community_service_schema->id,
        ]);

        $communityServices = CommunityService::query()
            ->where('title', $title)
            ->where('community_service_schema_id', $community_service_schema->id)
            ->get();
        $this->assertCount(1, $communityServices);
        $communityService = $communityServices->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $communityService = CommunityService::factory()->create();

        $response = $this->get(route('community-services.show', $communityService));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CommunityServiceController::class,
            'update',
            \App\Http\Requests\CommunityServiceUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $communityService = CommunityService::factory()->create();
        $title = $this->faker->sentence(4);
        $community_service_schema = CommunityServiceSchema::factory()->create();

        $response = $this->put(route('community-services.update', $communityService), [
            'title' => $title,
            'community_service_schema_id' => $community_service_schema->id,
        ]);

        $communityService->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $communityService->title);
        $this->assertEquals($community_service_schema->id, $communityService->community_service_schema_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $communityService = CommunityService::factory()->create();

        $response = $this->delete(route('community-services.destroy', $communityService));

        $response->assertNoContent();

        $this->assertModelMissing($communityService);
    }
}
