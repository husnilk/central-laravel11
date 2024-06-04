<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Curriculum;
use App\Models\CurriculumPlo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CurriculumPloController
 */
final class CurriculumPloControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $curriculumPlos = CurriculumPlo::factory()->count(3)->create();

        $response = $this->get(route('curriculum-plos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumPloController::class,
            'store',
            \App\Http\Requests\CurriculumPloStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $curriculum = Curriculum::factory()->create();
        $code = $this->faker->word();
        $outcome = $this->faker->text();
        $min_grade = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('curriculum-plos.store'), [
            'curriculum_id' => $curriculum->id,
            'code' => $code,
            'outcome' => $outcome,
            'min_grade' => $min_grade,
        ]);

        $curriculumPlos = CurriculumPlo::query()
            ->where('curriculum_id', $curriculum->id)
            ->where('code', $code)
            ->where('outcome', $outcome)
            ->where('min_grade', $min_grade)
            ->get();
        $this->assertCount(1, $curriculumPlos);
        $curriculumPlo = $curriculumPlos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $curriculumPlo = CurriculumPlo::factory()->create();

        $response = $this->get(route('curriculum-plos.show', $curriculumPlo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumPloController::class,
            'update',
            \App\Http\Requests\CurriculumPloUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $curriculumPlo = CurriculumPlo::factory()->create();
        $curriculum = Curriculum::factory()->create();
        $code = $this->faker->word();
        $outcome = $this->faker->text();
        $min_grade = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('curriculum-plos.update', $curriculumPlo), [
            'curriculum_id' => $curriculum->id,
            'code' => $code,
            'outcome' => $outcome,
            'min_grade' => $min_grade,
        ]);

        $curriculumPlo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($curriculum->id, $curriculumPlo->curriculum_id);
        $this->assertEquals($code, $curriculumPlo->code);
        $this->assertEquals($outcome, $curriculumPlo->outcome);
        $this->assertEquals($min_grade, $curriculumPlo->min_grade);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $curriculumPlo = CurriculumPlo::factory()->create();

        $response = $this->delete(route('curriculum-plos.destroy', $curriculumPlo));

        $response->assertNoContent();

        $this->assertModelMissing($curriculumPlo);
    }
}
