<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CreatedBy;
use App\Models\Lecturer;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisSupervisorController
 */
final class ThesisSupervisorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisSupervisors = ThesisSupervisor::factory()->count(3)->create();

        $response = $this->get(route('thesis-supervisors.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisSupervisorController::class,
            'store',
            \App\Http\Requests\ThesisSupervisorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis = Thesis::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->numberBetween(-10000, 10000);
        $created_by = CreatedBy::factory()->create();

        $response = $this->post(route('thesis-supervisors.store'), [
            'thesis_id' => $thesis->id,
            'lecturer_id' => $lecturer->id,
            'position' => $position,
            'status' => $status,
            'created_by' => $created_by->id,
        ]);

        $thesisSupervisors = ThesisSupervisor::query()
            ->where('thesis_id', $thesis->id)
            ->where('lecturer_id', $lecturer->id)
            ->where('position', $position)
            ->where('status', $status)
            ->where('created_by', $created_by->id)
            ->get();
        $this->assertCount(1, $thesisSupervisors);
        $thesisSupervisor = $thesisSupervisors->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisSupervisor = ThesisSupervisor::factory()->create();

        $response = $this->get(route('thesis-supervisors.show', $thesisSupervisor));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisSupervisorController::class,
            'update',
            \App\Http\Requests\ThesisSupervisorUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisSupervisor = ThesisSupervisor::factory()->create();
        $thesis = Thesis::factory()->create();
        $lecturer = Lecturer::factory()->create();
        $position = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->numberBetween(-10000, 10000);
        $created_by = CreatedBy::factory()->create();

        $response = $this->put(route('thesis-supervisors.update', $thesisSupervisor), [
            'thesis_id' => $thesis->id,
            'lecturer_id' => $lecturer->id,
            'position' => $position,
            'status' => $status,
            'created_by' => $created_by->id,
        ]);

        $thesisSupervisor->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis->id, $thesisSupervisor->thesis_id);
        $this->assertEquals($lecturer->id, $thesisSupervisor->lecturer_id);
        $this->assertEquals($position, $thesisSupervisor->position);
        $this->assertEquals($status, $thesisSupervisor->status);
        $this->assertEquals($created_by->id, $thesisSupervisor->created_by);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisSupervisor = ThesisSupervisor::factory()->create();

        $response = $this->delete(route('thesis-supervisors.destroy', $thesisSupervisor));

        $response->assertNoContent();

        $this->assertModelMissing($thesisSupervisor);
    }
}
