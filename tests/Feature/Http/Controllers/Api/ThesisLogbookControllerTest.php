<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Supervisor;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use App\Models\ThesisSupervisor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisLogbookController
 */
final class ThesisLogbookControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisLogbooks = ThesisLogbook::factory()->count(3)->create();

        $response = $this->get(route('thesis-logbooks.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisLogbookController::class,
            'store',
            \App\Http\Requests\ThesisLogbookStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis = Thesis::factory()->create();
        $supervisor = Supervisor::factory()->create();
        $date = Carbon::parse($this->faker->date());
        $progress = $this->faker->text();
        $status = $this->faker->numberBetween(-10000, 10000);
        $thesis_supervisor = ThesisSupervisor::factory()->create();

        $response = $this->post(route('thesis-logbooks.store'), [
            'thesis_id' => $thesis->id,
            'supervisor_id' => $supervisor->id,
            'date' => $date->toDateString(),
            'progress' => $progress,
            'status' => $status,
            'thesis_supervisor_id' => $thesis_supervisor->id,
        ]);

        $thesisLogbooks = ThesisLogbook::query()
            ->where('thesis_id', $thesis->id)
            ->where('supervisor_id', $supervisor->id)
            ->where('date', $date)
            ->where('progress', $progress)
            ->where('status', $status)
            ->where('thesis_supervisor_id', $thesis_supervisor->id)
            ->get();
        $this->assertCount(1, $thesisLogbooks);
        $thesisLogbook = $thesisLogbooks->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisLogbook = ThesisLogbook::factory()->create();

        $response = $this->get(route('thesis-logbooks.show', $thesisLogbook));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisLogbookController::class,
            'update',
            \App\Http\Requests\ThesisLogbookUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisLogbook = ThesisLogbook::factory()->create();
        $thesis = Thesis::factory()->create();
        $supervisor = Supervisor::factory()->create();
        $date = Carbon::parse($this->faker->date());
        $progress = $this->faker->text();
        $status = $this->faker->numberBetween(-10000, 10000);
        $thesis_supervisor = ThesisSupervisor::factory()->create();

        $response = $this->put(route('thesis-logbooks.update', $thesisLogbook), [
            'thesis_id' => $thesis->id,
            'supervisor_id' => $supervisor->id,
            'date' => $date->toDateString(),
            'progress' => $progress,
            'status' => $status,
            'thesis_supervisor_id' => $thesis_supervisor->id,
        ]);

        $thesisLogbook->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis->id, $thesisLogbook->thesis_id);
        $this->assertEquals($supervisor->id, $thesisLogbook->supervisor_id);
        $this->assertEquals($date, $thesisLogbook->date);
        $this->assertEquals($progress, $thesisLogbook->progress);
        $this->assertEquals($status, $thesisLogbook->status);
        $this->assertEquals($thesis_supervisor->id, $thesisLogbook->thesis_supervisor_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisLogbook = ThesisLogbook::factory()->create();

        $response = $this->delete(route('thesis-logbooks.destroy', $thesisLogbook));

        $response->assertNoContent();

        $this->assertModelMissing($thesisLogbook);
    }
}
