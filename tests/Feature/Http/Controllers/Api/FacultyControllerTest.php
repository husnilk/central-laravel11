<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Faculty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\FacultyController
 */
final class FacultyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $faculties = Faculty::factory()->count(3)->create();

        $response = $this->get(route('faculties.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\FacultyController::class,
            'store',
            \App\Http\Requests\FacultyStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $type = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('faculties.store'), [
            'name' => $name,
            'type' => $type,
        ]);

        $faculties = Faculty::query()
            ->where('name', $name)
            ->where('type', $type)
            ->get();
        $this->assertCount(1, $faculties);
        $faculty = $faculties->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $faculty = Faculty::factory()->create();

        $response = $this->get(route('faculties.show', $faculty));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\FacultyController::class,
            'update',
            \App\Http\Requests\FacultyUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $faculty = Faculty::factory()->create();
        $name = $this->faker->name();
        $type = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('faculties.update', $faculty), [
            'name' => $name,
            'type' => $type,
        ]);

        $faculty->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $faculty->name);
        $this->assertEquals($type, $faculty->type);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $faculty = Faculty::factory()->create();

        $response = $this->delete(route('faculties.destroy', $faculty));

        $response->assertNoContent();

        $this->assertModelMissing($faculty);
    }
}
