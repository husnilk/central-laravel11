<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\Bo\StudentController
 */
final class StudentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $students = Student::factory()->count(3)->create();

        $response = $this->get(route('students.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\Bo\StudentController::class,
            'store',
            \App\Http\Requests\StudentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $nim = $this->faker->word();
        $name = $this->faker->name();
        $department = Department::factory()->create();
        $religion = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('students.store'), [
            'nim' => $nim,
            'name' => $name,
            'department_id' => $department->id,
            'religion' => $religion,
            'status' => $status,
        ]);

        $students = Student::query()
            ->where('nim', $nim)
            ->where('name', $name)
            ->where('department_id', $department->id)
            ->where('religion', $religion)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $students);
        $student = $students->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $student = Student::factory()->create();

        $response = $this->get(route('students.show', $student));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\Bo\StudentController::class,
            'update',
            \App\Http\Requests\StudentUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $student = Student::factory()->create();
        $nim = $this->faker->word();
        $name = $this->faker->name();
        $department = Department::factory()->create();
        $religion = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('students.update', $student), [
            'nim' => $nim,
            'name' => $name,
            'department_id' => $department->id,
            'religion' => $religion,
            'status' => $status,
        ]);

        $student->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($nim, $student->nim);
        $this->assertEquals($name, $student->name);
        $this->assertEquals($department->id, $student->department_id);
        $this->assertEquals($religion, $student->religion);
        $this->assertEquals($status, $student->status);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $student = Student::factory()->create();

        $response = $this->delete(route('students.destroy', $student));

        $response->assertNoContent();

        $this->assertModelMissing($student);
    }
}
