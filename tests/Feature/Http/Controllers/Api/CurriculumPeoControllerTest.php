<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Curriculum;
use App\Models\CurriculumPeo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CurriculumPeoController
 */
final class CurriculumPeoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $curriculumPeos = CurriculumPeo::factory()->count(3)->create();

        $response = $this->get(route('curriculum-peos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumPeoController::class,
            'store',
            \App\Http\Requests\CurriculumPeoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $curriculum = Curriculum::factory()->create();
        $code = $this->faker->word();
        $profile = $this->faker->text();

        $response = $this->post(route('curriculum-peos.store'), [
            'curriculum_id' => $curriculum->id,
            'code' => $code,
            'profile' => $profile,
        ]);

        $curriculumPeos = CurriculumPeo::query()
            ->where('curriculum_id', $curriculum->id)
            ->where('code', $code)
            ->where('profile', $profile)
            ->get();
        $this->assertCount(1, $curriculumPeos);
        $curriculumPeo = $curriculumPeos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $curriculumPeo = CurriculumPeo::factory()->create();

        $response = $this->get(route('curriculum-peos.show', $curriculumPeo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumPeoController::class,
            'update',
            \App\Http\Requests\CurriculumPeoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $curriculumPeo = CurriculumPeo::factory()->create();
        $curriculum = Curriculum::factory()->create();
        $code = $this->faker->word();
        $profile = $this->faker->text();

        $response = $this->put(route('curriculum-peos.update', $curriculumPeo), [
            'curriculum_id' => $curriculum->id,
            'code' => $code,
            'profile' => $profile,
        ]);

        $curriculumPeo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($curriculum->id, $curriculumPeo->curriculum_id);
        $this->assertEquals($code, $curriculumPeo->code);
        $this->assertEquals($profile, $curriculumPeo->profile);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $curriculumPeo = CurriculumPeo::factory()->create();

        $response = $this->delete(route('curriculum-peos.destroy', $curriculumPeo));

        $response->assertNoContent();

        $this->assertModelMissing($curriculumPeo);
    }
}
