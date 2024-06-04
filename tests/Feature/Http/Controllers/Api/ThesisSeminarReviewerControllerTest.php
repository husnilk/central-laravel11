<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Lecturer;
use App\Models\Reviewer;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarReviewer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisSeminarReviewerController
 */
final class ThesisSeminarReviewerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisSeminarReviewers = ThesisSeminarReviewer::factory()->count(3)->create();

        $response = $this->get(route('thesis-seminar-reviewers.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisSeminarReviewerController::class,
            'store',
            \App\Http\Requests\ThesisSeminarReviewerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis_seminar = ThesisSeminar::factory()->create();
        $reviewer = Reviewer::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $lecturer = Lecturer::factory()->create();

        $response = $this->post(route('thesis-seminar-reviewers.store'), [
            'thesis_seminar_id' => $thesis_seminar->id,
            'reviewer_id' => $reviewer->id,
            'status' => $status,
            'lecturer_id' => $lecturer->id,
        ]);

        $thesisSeminarReviewers = ThesisSeminarReviewer::query()
            ->where('thesis_seminar_id', $thesis_seminar->id)
            ->where('reviewer_id', $reviewer->id)
            ->where('status', $status)
            ->where('lecturer_id', $lecturer->id)
            ->get();
        $this->assertCount(1, $thesisSeminarReviewers);
        $thesisSeminarReviewer = $thesisSeminarReviewers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisSeminarReviewer = ThesisSeminarReviewer::factory()->create();

        $response = $this->get(route('thesis-seminar-reviewers.show', $thesisSeminarReviewer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisSeminarReviewerController::class,
            'update',
            \App\Http\Requests\ThesisSeminarReviewerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisSeminarReviewer = ThesisSeminarReviewer::factory()->create();
        $thesis_seminar = ThesisSeminar::factory()->create();
        $reviewer = Reviewer::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $lecturer = Lecturer::factory()->create();

        $response = $this->put(route('thesis-seminar-reviewers.update', $thesisSeminarReviewer), [
            'thesis_seminar_id' => $thesis_seminar->id,
            'reviewer_id' => $reviewer->id,
            'status' => $status,
            'lecturer_id' => $lecturer->id,
        ]);

        $thesisSeminarReviewer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis_seminar->id, $thesisSeminarReviewer->thesis_seminar_id);
        $this->assertEquals($reviewer->id, $thesisSeminarReviewer->reviewer_id);
        $this->assertEquals($status, $thesisSeminarReviewer->status);
        $this->assertEquals($lecturer->id, $thesisSeminarReviewer->lecturer_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisSeminarReviewer = ThesisSeminarReviewer::factory()->create();

        $response = $this->delete(route('thesis-seminar-reviewers.destroy', $thesisSeminarReviewer));

        $response->assertNoContent();

        $this->assertModelMissing($thesisSeminarReviewer);
    }
}
