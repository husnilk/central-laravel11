<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Curriculum;
use App\Models\CurriculumBok;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CurriculumBokController
 */
final class CurriculumBokControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $curriculumBoks = CurriculumBok::factory()->count(3)->create();

        $response = $this->get(route('curriculum-boks.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumBokController::class,
            'store',
            \App\Http\Requests\CurriculumBokStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $curriculum = Curriculum::factory()->create();
        $code = $this->faker->word();
        $name = $this->faker->name();

        $response = $this->post(route('curriculum-boks.store'), [
            'curriculum_id' => $curriculum->id,
            'code' => $code,
            'name' => $name,
        ]);

        $curriculumBoks = CurriculumBok::query()
            ->where('curriculum_id', $curriculum->id)
            ->where('code', $code)
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $curriculumBoks);
        $curriculumBok = $curriculumBoks->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $curriculumBok = CurriculumBok::factory()->create();

        $response = $this->get(route('curriculum-boks.show', $curriculumBok));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumBokController::class,
            'update',
            \App\Http\Requests\CurriculumBokUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $curriculumBok = CurriculumBok::factory()->create();
        $curriculum = Curriculum::factory()->create();
        $code = $this->faker->word();
        $name = $this->faker->name();

        $response = $this->put(route('curriculum-boks.update', $curriculumBok), [
            'curriculum_id' => $curriculum->id,
            'code' => $code,
            'name' => $name,
        ]);

        $curriculumBok->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($curriculum->id, $curriculumBok->curriculum_id);
        $this->assertEquals($code, $curriculumBok->code);
        $this->assertEquals($name, $curriculumBok->name);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $curriculumBok = CurriculumBok::factory()->create();

        $response = $this->delete(route('curriculum-boks.destroy', $curriculumBok));

        $response->assertNoContent();

        $this->assertModelMissing($curriculumBok);
    }
}
