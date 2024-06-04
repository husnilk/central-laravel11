<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CurriculumBok;
use App\Models\CurriculumBokDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CurriculumBokDetailController
 */
final class CurriculumBokDetailControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $curriculumBokDetails = CurriculumBokDetail::factory()->count(3)->create();

        $response = $this->get(route('curriculum-bok-details.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumBokDetailController::class,
            'store',
            \App\Http\Requests\CurriculumBokDetailStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $curriculum_bok = CurriculumBok::factory()->create();
        $lo = $this->faker->text();

        $response = $this->post(route('curriculum-bok-details.store'), [
            'curriculum_bok_id' => $curriculum_bok->id,
            'lo' => $lo,
        ]);

        $curriculumBokDetails = CurriculumBokDetail::query()
            ->where('curriculum_bok_id', $curriculum_bok->id)
            ->where('lo', $lo)
            ->get();
        $this->assertCount(1, $curriculumBokDetails);
        $curriculumBokDetail = $curriculumBokDetails->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $curriculumBokDetail = CurriculumBokDetail::factory()->create();

        $response = $this->get(route('curriculum-bok-details.show', $curriculumBokDetail));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumBokDetailController::class,
            'update',
            \App\Http\Requests\CurriculumBokDetailUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $curriculumBokDetail = CurriculumBokDetail::factory()->create();
        $curriculum_bok = CurriculumBok::factory()->create();
        $lo = $this->faker->text();

        $response = $this->put(route('curriculum-bok-details.update', $curriculumBokDetail), [
            'curriculum_bok_id' => $curriculum_bok->id,
            'lo' => $lo,
        ]);

        $curriculumBokDetail->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($curriculum_bok->id, $curriculumBokDetail->curriculum_bok_id);
        $this->assertEquals($lo, $curriculumBokDetail->lo);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $curriculumBokDetail = CurriculumBokDetail::factory()->create();

        $response = $this->delete(route('curriculum-bok-details.destroy', $curriculumBokDetail));

        $response->assertNoContent();

        $this->assertModelMissing($curriculumBokDetail);
    }
}
