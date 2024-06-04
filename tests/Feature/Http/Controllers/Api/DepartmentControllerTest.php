<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\DepartmentController
 */
final class DepartmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $departments = Department::factory()->count(3)->create();

        $response = $this->get(route('departments.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\DepartmentController::class,
            'store',
            \App\Http\Requests\DepartmentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $faculty = Faculty::factory()->create();

        $response = $this->post(route('departments.store'), [
            'name' => $name,
            'faculty_id' => $faculty->id,
        ]);

        $departments = Department::query()
            ->where('name', $name)
            ->where('faculty_id', $faculty->id)
            ->get();
        $this->assertCount(1, $departments);
        $department = $departments->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $department = Department::factory()->create();

        $response = $this->get(route('departments.show', $department));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\DepartmentController::class,
            'update',
            \App\Http\Requests\DepartmentUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $department = Department::factory()->create();
        $name = $this->faker->name();
        $faculty = Faculty::factory()->create();

        $response = $this->put(route('departments.update', $department), [
            'name' => $name,
            'faculty_id' => $faculty->id,
        ]);

        $department->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $department->name);
        $this->assertEquals($faculty->id, $department->faculty_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $department = Department::factory()->create();

        $response = $this->delete(route('departments.destroy', $department));

        $response->assertNoContent();

        $this->assertModelMissing($department);
    }
}
