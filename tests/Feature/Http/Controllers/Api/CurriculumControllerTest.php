<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Curriculum;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CurriculumController
 */
final class CurriculumControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $curricula = Curriculum::factory()->count(3)->create();

        $response = $this->get(route('curricula.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumController::class,
            'store',
            \App\Http\Requests\CurriculumStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $department = Department::factory()->create();
        $year_start = $this->faker->numberBetween(-10000, 10000);
        $year_end = $this->faker->numberBetween(-10000, 10000);
        $active = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('curricula.store'), [
            'name' => $name,
            'department_id' => $department->id,
            'year_start' => $year_start,
            'year_end' => $year_end,
            'active' => $active,
        ]);

        $curricula = Curriculum::query()
            ->where('name', $name)
            ->where('department_id', $department->id)
            ->where('year_start', $year_start)
            ->where('year_end', $year_end)
            ->where('active', $active)
            ->get();
        $this->assertCount(1, $curricula);
        $curriculum = $curricula->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $curriculum = Curriculum::factory()->create();

        $response = $this->get(route('curricula.show', $curriculum));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CurriculumController::class,
            'update',
            \App\Http\Requests\CurriculumUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $curriculum = Curriculum::factory()->create();
        $name = $this->faker->name();
        $department = Department::factory()->create();
        $year_start = $this->faker->numberBetween(-10000, 10000);
        $year_end = $this->faker->numberBetween(-10000, 10000);
        $active = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('curricula.update', $curriculum), [
            'name' => $name,
            'department_id' => $department->id,
            'year_start' => $year_start,
            'year_end' => $year_end,
            'active' => $active,
        ]);

        $curriculum->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $curriculum->name);
        $this->assertEquals($department->id, $curriculum->department_id);
        $this->assertEquals($year_start, $curriculum->year_start);
        $this->assertEquals($year_end, $curriculum->year_end);
        $this->assertEquals($active, $curriculum->active);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $curriculum = Curriculum::factory()->create();

        $response = $this->delete(route('curricula.destroy', $curriculum));

        $response->assertNoContent();

        $this->assertModelMissing($curriculum);
    }
}
