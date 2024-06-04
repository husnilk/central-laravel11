<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Department;
use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\StaffController
 */
final class StaffControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $staff = Staff::factory()->count(3)->create();

        $response = $this->get(route('staff.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\StaffController::class,
            'store',
            \App\Http\Requests\StaffStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $nik = $this->faker->word();
        $name = $this->faker->name();
        $department = Department::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('staff.store'), [
            'nik' => $nik,
            'name' => $name,
            'department_id' => $department->id,
            'status' => $status,
        ]);

        $staff = Staff::query()
            ->where('nik', $nik)
            ->where('name', $name)
            ->where('department_id', $department->id)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $staff);
        $staff = $staff->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $staff = Staff::factory()->create();

        $response = $this->get(route('staff.show', $staff));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\StaffController::class,
            'update',
            \App\Http\Requests\StaffUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $staff = Staff::factory()->create();
        $nik = $this->faker->word();
        $name = $this->faker->name();
        $department = Department::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('staff.update', $staff), [
            'nik' => $nik,
            'name' => $name,
            'department_id' => $department->id,
            'status' => $status,
        ]);

        $staff->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nik, $staff->nik);
        $this->assertEquals($name, $staff->name);
        $this->assertEquals($department->id, $staff->department_id);
        $this->assertEquals($status, $staff->status);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $staff = Staff::factory()->create();

        $response = $this->delete(route('staff.destroy', $staff));

        $response->assertNoContent();

        $this->assertModelMissing($staff);
    }
}
