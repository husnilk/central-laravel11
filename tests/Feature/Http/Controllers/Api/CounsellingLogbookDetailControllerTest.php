<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CounsellingLogbook;
use App\Models\CounsellingLogbookDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CounsellingLogbookDetailController
 */
final class CounsellingLogbookDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $counsellingLogbookDetails = CounsellingLogbookDetail::factory()->count(3)->create();

        $response = $this->get(route('counselling-logbook-details.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CounsellingLogbookDetailController::class,
            'store',
            \App\Http\Requests\CounsellingLogbookDetailStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $no = $this->faker->numberBetween(-10000, 10000);
        $counselling_logbook = CounsellingLogbook::factory()->create();
        $user = User::factory()->create();

        $response = $this->post(route('counselling-logbook-details.store'), [
            'no' => $no,
            'counselling_logbook_id' => $counselling_logbook->id,
            'user_id' => $user->id,
        ]);

        $counsellingLogbookDetails = CounsellingLogbookDetail::query()
            ->where('no', $no)
            ->where('counselling_logbook_id', $counselling_logbook->id)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $counsellingLogbookDetails);
        $counsellingLogbookDetail = $counsellingLogbookDetails->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $counsellingLogbookDetail = CounsellingLogbookDetail::factory()->create();

        $response = $this->get(route('counselling-logbook-details.show', $counsellingLogbookDetail));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CounsellingLogbookDetailController::class,
            'update',
            \App\Http\Requests\CounsellingLogbookDetailUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $counsellingLogbookDetail = CounsellingLogbookDetail::factory()->create();
        $no = $this->faker->numberBetween(-10000, 10000);
        $counselling_logbook = CounsellingLogbook::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('counselling-logbook-details.update', $counsellingLogbookDetail), [
            'no' => $no,
            'counselling_logbook_id' => $counselling_logbook->id,
            'user_id' => $user->id,
        ]);

        $counsellingLogbookDetail->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($no, $counsellingLogbookDetail->no);
        $this->assertEquals($counselling_logbook->id, $counsellingLogbookDetail->counselling_logbook_id);
        $this->assertEquals($user->id, $counsellingLogbookDetail->user_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $counsellingLogbookDetail = CounsellingLogbookDetail::factory()->create();

        $response = $this->delete(route('counselling-logbook-details.destroy', $counsellingLogbookDetail));

        $response->assertNoContent();

        $this->assertModelMissing($counsellingLogbookDetail);
    }
}
