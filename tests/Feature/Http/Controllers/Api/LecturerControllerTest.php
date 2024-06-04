<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\LecturerController
 */
final class LecturerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $lecturers = Lecturer::factory()->count(3)->create();

        $response = $this->get(route('lecturers.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\LecturerController::class,
            'store',
            \App\Http\Requests\LecturerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $nik = $this->faker->word();
        $name = $this->faker->name();
        $department = Department::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('lecturers.store'), [
            'nik' => $nik,
            'name' => $name,
            'department_id' => $department->id,
            'status' => $status,
        ]);

        $lecturers = Lecturer::query()
            ->where('nik', $nik)
            ->where('name', $name)
            ->where('department_id', $department->id)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $lecturers);
        $lecturer = $lecturers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $lecturer = Lecturer::factory()->create();

        $response = $this->get(route('lecturers.show', $lecturer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\LecturerController::class,
            'update',
            \App\Http\Requests\LecturerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $lecturer = Lecturer::factory()->create();
        $nik = $this->faker->word();
        $name = $this->faker->name();
        $department = Department::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('lecturers.update', $lecturer), [
            'nik' => $nik,
            'name' => $name,
            'department_id' => $department->id,
            'status' => $status,
        ]);

        $lecturer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nik, $lecturer->nik);
        $this->assertEquals($name, $lecturer->name);
        $this->assertEquals($department->id, $lecturer->department_id);
        $this->assertEquals($status, $lecturer->status);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $lecturer = Lecturer::factory()->create();

        $response = $this->delete(route('lecturers.destroy', $lecturer));

        $response->assertNoContent();

        $this->assertModelMissing($lecturer);
    }
}
