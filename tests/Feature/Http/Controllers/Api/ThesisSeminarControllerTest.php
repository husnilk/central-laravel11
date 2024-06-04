<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Thesis;
use App\Models\ThesisSeminar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisSeminarController
 */
final class ThesisSeminarControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisSeminars = ThesisSeminar::factory()->count(3)->create();

        $response = $this->get(route('thesis-seminars.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisSeminarController::class,
            'store',
            \App\Http\Requests\ThesisSeminarStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis = Thesis::factory()->create();
        $method = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('thesis-seminars.store'), [
            'thesis_id' => $thesis->id,
            'method' => $method,
            'status' => $status,
        ]);

        $thesisSeminars = ThesisSeminar::query()
            ->where('thesis_id', $thesis->id)
            ->where('method', $method)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $thesisSeminars);
        $thesisSeminar = $thesisSeminars->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisSeminar = ThesisSeminar::factory()->create();

        $response = $this->get(route('thesis-seminars.show', $thesisSeminar));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisSeminarController::class,
            'update',
            \App\Http\Requests\ThesisSeminarUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisSeminar = ThesisSeminar::factory()->create();
        $thesis = Thesis::factory()->create();
        $method = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('thesis-seminars.update', $thesisSeminar), [
            'thesis_id' => $thesis->id,
            'method' => $method,
            'status' => $status,
        ]);

        $thesisSeminar->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis->id, $thesisSeminar->thesis_id);
        $this->assertEquals($method, $thesisSeminar->method);
        $this->assertEquals($status, $thesisSeminar->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisSeminar = ThesisSeminar::factory()->create();

        $response = $this->delete(route('thesis-seminars.destroy', $thesisSeminar));

        $response->assertNoContent();

        $this->assertModelMissing($thesisSeminar);
    }
}
