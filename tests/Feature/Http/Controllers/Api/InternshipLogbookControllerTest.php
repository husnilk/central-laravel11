<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Internship;
use App\Models\InternshipLogbook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\InternshipLogbookController
 */
final class InternshipLogbookControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $internshipLogbooks = InternshipLogbook::factory()->count(3)->create();

        $response = $this->get(route('internship-logbooks.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipLogbookController::class,
            'store',
            \App\Http\Requests\InternshipLogbookStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $internship = Internship::factory()->create();
        $date = Carbon::parse($this->faker->date());

        $response = $this->post(route('internship-logbooks.store'), [
            'internship_id' => $internship->id,
            'date' => $date->toDateString(),
        ]);

        $internshipLogbooks = InternshipLogbook::query()
            ->where('internship_id', $internship->id)
            ->where('date', $date)
            ->get();
        $this->assertCount(1, $internshipLogbooks);
        $internshipLogbook = $internshipLogbooks->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $internshipLogbook = InternshipLogbook::factory()->create();

        $response = $this->get(route('internship-logbooks.show', $internshipLogbook));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipLogbookController::class,
            'update',
            \App\Http\Requests\InternshipLogbookUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $internshipLogbook = InternshipLogbook::factory()->create();
        $internship = Internship::factory()->create();
        $date = Carbon::parse($this->faker->date());

        $response = $this->put(route('internship-logbooks.update', $internshipLogbook), [
            'internship_id' => $internship->id,
            'date' => $date->toDateString(),
        ]);

        $internshipLogbook->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($internship->id, $internshipLogbook->internship_id);
        $this->assertEquals($date, $internshipLogbook->date);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $internshipLogbook = InternshipLogbook::factory()->create();

        $response = $this->delete(route('internship-logbooks.destroy', $internshipLogbook));

        $response->assertNoContent();

        $this->assertModelMissing($internshipLogbook);
    }
}
