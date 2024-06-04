<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CurriculumPeo;
use App\Models\CurriculumPeoPlo;
use App\Models\CurriculumPlo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CurriculumPeoPloController
 */
final class CurriculumPeoPloControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $curriculumPeoPlos = CurriculumPeoPlo::factory()->count(3)->create();

        $response = $this->get(route('curriculum-peo-plos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumPeoPloController::class,
            'store',
            \App\Http\Requests\CurriculumPeoPloStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $curriculum_peo = CurriculumPeo::factory()->create();
        $curriculum_plo = CurriculumPlo::factory()->create();

        $response = $this->post(route('curriculum-peo-plos.store'), [
            'curriculum_peo_id' => $curriculum_peo->id,
            'curriculum_plo_id' => $curriculum_plo->id,
        ]);

        $curriculumPeoPlos = CurriculumPeoPlo::query()
            ->where('curriculum_peo_id', $curriculum_peo->id)
            ->where('curriculum_plo_id', $curriculum_plo->id)
            ->get();
        $this->assertCount(1, $curriculumPeoPlos);
        $curriculumPeoPlo = $curriculumPeoPlos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $curriculumPeoPlo = CurriculumPeoPlo::factory()->create();

        $response = $this->get(route('curriculum-peo-plos.show', $curriculumPeoPlo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumPeoPloController::class,
            'update',
            \App\Http\Requests\CurriculumPeoPloUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $curriculumPeoPlo = CurriculumPeoPlo::factory()->create();
        $curriculum_peo = CurriculumPeo::factory()->create();
        $curriculum_plo = CurriculumPlo::factory()->create();

        $response = $this->put(route('curriculum-peo-plos.update', $curriculumPeoPlo), [
            'curriculum_peo_id' => $curriculum_peo->id,
            'curriculum_plo_id' => $curriculum_plo->id,
        ]);

        $curriculumPeoPlo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($curriculum_peo->id, $curriculumPeoPlo->curriculum_peo_id);
        $this->assertEquals($curriculum_plo->id, $curriculumPeoPlo->curriculum_plo_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $curriculumPeoPlo = CurriculumPeoPlo::factory()->create();

        $response = $this->delete(route('curriculum-peo-plos.destroy', $curriculumPeoPlo));

        $response->assertNoContent();

        $this->assertModelMissing($curriculumPeoPlo);
    }
}
