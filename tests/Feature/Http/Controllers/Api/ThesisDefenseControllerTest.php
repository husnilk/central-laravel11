<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Room;
use App\Models\Thesis;
use App\Models\ThesisDefense;
use App\Models\ThesisRubric;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisDefenseController
 */
final class ThesisDefenseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisDefenses = ThesisDefense::factory()->count(3)->create();

        $response = $this->get(route('thesis-defenses.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisDefenseController::class,
            'store',
            \App\Http\Requests\ThesisDefenseStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis = Thesis::factory()->create();
        $thesis_rubric = ThesisRubric::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $registered_at = Carbon::parse($this->faker->dateTime());
        $method = $this->faker->numberBetween(-10000, 10000);
        $room = Room::factory()->create();

        $response = $this->post(route('thesis-defenses.store'), [
            'thesis_id' => $thesis->id,
            'thesis_rubric_id' => $thesis_rubric->id,
            'status' => $status,
            'registered_at' => $registered_at->toDateTimeString(),
            'method' => $method,
            'room_id' => $room->id,
        ]);

        $thesisDefenses = ThesisDefense::query()
            ->where('thesis_id', $thesis->id)
            ->where('thesis_rubric_id', $thesis_rubric->id)
            ->where('status', $status)
            ->where('registered_at', $registered_at)
            ->where('method', $method)
            ->where('room_id', $room->id)
            ->get();
        $this->assertCount(1, $thesisDefenses);
        $thesisDefense = $thesisDefenses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisDefense = ThesisDefense::factory()->create();

        $response = $this->get(route('thesis-defenses.show', $thesisDefense));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisDefenseController::class,
            'update',
            \App\Http\Requests\ThesisDefenseUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisDefense = ThesisDefense::factory()->create();
        $thesis = Thesis::factory()->create();
        $thesis_rubric = ThesisRubric::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $registered_at = Carbon::parse($this->faker->dateTime());
        $method = $this->faker->numberBetween(-10000, 10000);
        $room = Room::factory()->create();

        $response = $this->put(route('thesis-defenses.update', $thesisDefense), [
            'thesis_id' => $thesis->id,
            'thesis_rubric_id' => $thesis_rubric->id,
            'status' => $status,
            'registered_at' => $registered_at->toDateTimeString(),
            'method' => $method,
            'room_id' => $room->id,
        ]);

        $thesisDefense->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis->id, $thesisDefense->thesis_id);
        $this->assertEquals($thesis_rubric->id, $thesisDefense->thesis_rubric_id);
        $this->assertEquals($status, $thesisDefense->status);
        $this->assertEquals($registered_at, $thesisDefense->registered_at);
        $this->assertEquals($method, $thesisDefense->method);
        $this->assertEquals($room->id, $thesisDefense->room_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisDefense = ThesisDefense::factory()->create();

        $response = $this->delete(route('thesis-defenses.destroy', $thesisDefense));

        $response->assertNoContent();

        $this->assertModelMissing($thesisDefense);
    }
}
