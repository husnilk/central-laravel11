<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ThesisDefenseExaminer;
use App\Models\ThesisDefenseScore;
use App\Models\ThesisRubricDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisDefenseScoreController
 */
final class ThesisDefenseScoreControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisDefenseScores = ThesisDefenseScore::factory()->count(3)->create();

        $response = $this->get(route('thesis-defense-scores.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisDefenseScoreController::class,
            'store',
            \App\Http\Requests\ThesisDefenseScoreStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis_defense_examiner = ThesisDefenseExaminer::factory()->create();
        $thesis_rubric_detail = ThesisRubricDetail::factory()->create();

        $response = $this->post(route('thesis-defense-scores.store'), [
            'thesis_defense_examiner_id' => $thesis_defense_examiner->id,
            'thesis_rubric_detail_id' => $thesis_rubric_detail->id,
        ]);

        $thesisDefenseScores = ThesisDefenseScore::query()
            ->where('thesis_defense_examiner_id', $thesis_defense_examiner->id)
            ->where('thesis_rubric_detail_id', $thesis_rubric_detail->id)
            ->get();
        $this->assertCount(1, $thesisDefenseScores);
        $thesisDefenseScore = $thesisDefenseScores->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisDefenseScore = ThesisDefenseScore::factory()->create();

        $response = $this->get(route('thesis-defense-scores.show', $thesisDefenseScore));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisDefenseScoreController::class,
            'update',
            \App\Http\Requests\ThesisDefenseScoreUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisDefenseScore = ThesisDefenseScore::factory()->create();
        $thesis_defense_examiner = ThesisDefenseExaminer::factory()->create();
        $thesis_rubric_detail = ThesisRubricDetail::factory()->create();

        $response = $this->put(route('thesis-defense-scores.update', $thesisDefenseScore), [
            'thesis_defense_examiner_id' => $thesis_defense_examiner->id,
            'thesis_rubric_detail_id' => $thesis_rubric_detail->id,
        ]);

        $thesisDefenseScore->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis_defense_examiner->id, $thesisDefenseScore->thesis_defense_examiner_id);
        $this->assertEquals($thesis_rubric_detail->id, $thesisDefenseScore->thesis_rubric_detail_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisDefenseScore = ThesisDefenseScore::factory()->create();

        $response = $this->delete(route('thesis-defense-scores.destroy', $thesisDefenseScore));

        $response->assertNoContent();

        $this->assertModelMissing($thesisDefenseScore);
    }
}
