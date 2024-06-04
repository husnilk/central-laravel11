<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Examiner;
use App\Models\Lecturer;
use App\Models\ThesisDefense;
use App\Models\ThesisDefenseExaminer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisDefenseExaminerController
 */
final class ThesisDefenseExaminerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisDefenseExaminers = ThesisDefenseExaminer::factory()->count(3)->create();

        $response = $this->get(route('thesis-defense-examiners.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisDefenseExaminerController::class,
            'store',
            \App\Http\Requests\ThesisDefenseExaminerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis_defense = ThesisDefense::factory()->create();
        $examiner = Examiner::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $position = $this->faker->numberBetween(-10000, 10000);
        $lecturer = Lecturer::factory()->create();

        $response = $this->post(route('thesis-defense-examiners.store'), [
            'thesis_defense_id' => $thesis_defense->id,
            'examiner_id' => $examiner->id,
            'status' => $status,
            'position' => $position,
            'lecturer_id' => $lecturer->id,
        ]);

        $thesisDefenseExaminers = ThesisDefenseExaminer::query()
            ->where('thesis_defense_id', $thesis_defense->id)
            ->where('examiner_id', $examiner->id)
            ->where('status', $status)
            ->where('position', $position)
            ->where('lecturer_id', $lecturer->id)
            ->get();
        $this->assertCount(1, $thesisDefenseExaminers);
        $thesisDefenseExaminer = $thesisDefenseExaminers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisDefenseExaminer = ThesisDefenseExaminer::factory()->create();

        $response = $this->get(route('thesis-defense-examiners.show', $thesisDefenseExaminer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisDefenseExaminerController::class,
            'update',
            \App\Http\Requests\ThesisDefenseExaminerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisDefenseExaminer = ThesisDefenseExaminer::factory()->create();
        $thesis_defense = ThesisDefense::factory()->create();
        $examiner = Examiner::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $position = $this->faker->numberBetween(-10000, 10000);
        $lecturer = Lecturer::factory()->create();

        $response = $this->put(route('thesis-defense-examiners.update', $thesisDefenseExaminer), [
            'thesis_defense_id' => $thesis_defense->id,
            'examiner_id' => $examiner->id,
            'status' => $status,
            'position' => $position,
            'lecturer_id' => $lecturer->id,
        ]);

        $thesisDefenseExaminer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis_defense->id, $thesisDefenseExaminer->thesis_defense_id);
        $this->assertEquals($examiner->id, $thesisDefenseExaminer->examiner_id);
        $this->assertEquals($status, $thesisDefenseExaminer->status);
        $this->assertEquals($position, $thesisDefenseExaminer->position);
        $this->assertEquals($lecturer->id, $thesisDefenseExaminer->lecturer_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisDefenseExaminer = ThesisDefenseExaminer::factory()->create();

        $response = $this->delete(route('thesis-defense-examiners.destroy', $thesisDefenseExaminer));

        $response->assertNoContent();

        $this->assertModelMissing($thesisDefenseExaminer);
    }
}
