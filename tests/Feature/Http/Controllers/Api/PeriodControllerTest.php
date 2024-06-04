<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Period;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\PeriodController
 */
final class PeriodControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $periods = Period::factory()->count(3)->create();

        $response = $this->get(route('periods.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PeriodController::class,
            'store',
            \App\Http\Requests\PeriodStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $year = $this->faker->numberBetween(-10000, 10000);
        $semester = $this->faker->numberBetween(-10000, 10000);
        $active = $this->faker->boolean();

        $response = $this->post(route('periods.store'), [
            'year' => $year,
            'semester' => $semester,
            'active' => $active,
        ]);

        $periods = Period::query()
            ->where('year', $year)
            ->where('semester', $semester)
            ->where('active', $active)
            ->get();
        $this->assertCount(1, $periods);
        $period = $periods->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $period = Period::factory()->create();

        $response = $this->get(route('periods.show', $period));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PeriodController::class,
            'update',
            \App\Http\Requests\PeriodUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $period = Period::factory()->create();
        $year = $this->faker->numberBetween(-10000, 10000);
        $semester = $this->faker->numberBetween(-10000, 10000);
        $active = $this->faker->boolean();

        $response = $this->put(route('periods.update', $period), [
            'year' => $year,
            'semester' => $semester,
            'active' => $active,
        ]);

        $period->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($year, $period->year);
        $this->assertEquals($semester, $period->semester);
        $this->assertEquals($active, $period->active);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $period = Period::factory()->create();

        $response = $this->delete(route('periods.destroy', $period));

        $response->assertNoContent();

        $this->assertModelMissing($period);
    }
}
