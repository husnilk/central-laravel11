<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CurriculumIndicator;
use App\Models\CurriculumPlo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CurriculumIndicatorController
 */
final class CurriculumIndicatorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $curriculumIndicators = CurriculumIndicator::factory()->count(3)->create();

        $response = $this->get(route('curriculum-indicators.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumIndicatorController::class,
            'store',
            \App\Http\Requests\CurriculumIndicatorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $curriculum_plo = CurriculumPlo::factory()->create();
        $code = $this->faker->word();
        $indicator = $this->faker->word();
        $min_grade = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('curriculum-indicators.store'), [
            'curriculum_plo_id' => $curriculum_plo->id,
            'code' => $code,
            'indicator' => $indicator,
            'min_grade' => $min_grade,
        ]);

        $curriculumIndicators = CurriculumIndicator::query()
            ->where('curriculum_plo_id', $curriculum_plo->id)
            ->where('code', $code)
            ->where('indicator', $indicator)
            ->where('min_grade', $min_grade)
            ->get();
        $this->assertCount(1, $curriculumIndicators);
        $curriculumIndicator = $curriculumIndicators->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $curriculumIndicator = CurriculumIndicator::factory()->create();

        $response = $this->get(route('curriculum-indicators.show', $curriculumIndicator));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumIndicatorController::class,
            'update',
            \App\Http\Requests\CurriculumIndicatorUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $curriculumIndicator = CurriculumIndicator::factory()->create();
        $curriculum_plo = CurriculumPlo::factory()->create();
        $code = $this->faker->word();
        $indicator = $this->faker->word();
        $min_grade = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('curriculum-indicators.update', $curriculumIndicator), [
            'curriculum_plo_id' => $curriculum_plo->id,
            'code' => $code,
            'indicator' => $indicator,
            'min_grade' => $min_grade,
        ]);

        $curriculumIndicator->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($curriculum_plo->id, $curriculumIndicator->curriculum_plo_id);
        $this->assertEquals($code, $curriculumIndicator->code);
        $this->assertEquals($indicator, $curriculumIndicator->indicator);
        $this->assertEquals($min_grade, $curriculumIndicator->min_grade);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $curriculumIndicator = CurriculumIndicator::factory()->create();

        $response = $this->delete(route('curriculum-indicators.destroy', $curriculumIndicator));

        $response->assertNoContent();

        $this->assertModelMissing($curriculumIndicator);
    }
}
