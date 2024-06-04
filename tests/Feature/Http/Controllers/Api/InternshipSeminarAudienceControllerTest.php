<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Internship;
use App\Models\InternshipSeminarAudience;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\InternshipSeminarAudienceController
 */
final class InternshipSeminarAudienceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $internshipSeminarAudiences = InternshipSeminarAudience::factory()->count(3)->create();

        $response = $this->get(route('internship-seminar-audiences.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipSeminarAudienceController::class,
            'store',
            \App\Http\Requests\InternshipSeminarAudienceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $internship = Internship::factory()->create();
        $student = Student::factory()->create();
        $role = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('internship-seminar-audiences.store'), [
            'internship_id' => $internship->id,
            'student_id' => $student->id,
            'role' => $role,
        ]);

        $internshipSeminarAudiences = InternshipSeminarAudience::query()
            ->where('internship_id', $internship->id)
            ->where('student_id', $student->id)
            ->where('role', $role)
            ->get();
        $this->assertCount(1, $internshipSeminarAudiences);
        $internshipSeminarAudience = $internshipSeminarAudiences->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $internshipSeminarAudience = InternshipSeminarAudience::factory()->create();

        $response = $this->get(route('internship-seminar-audiences.show', $internshipSeminarAudience));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipSeminarAudienceController::class,
            'update',
            \App\Http\Requests\InternshipSeminarAudienceUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $internshipSeminarAudience = InternshipSeminarAudience::factory()->create();
        $internship = Internship::factory()->create();
        $student = Student::factory()->create();
        $role = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('internship-seminar-audiences.update', $internshipSeminarAudience), [
            'internship_id' => $internship->id,
            'student_id' => $student->id,
            'role' => $role,
        ]);

        $internshipSeminarAudience->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($internship->id, $internshipSeminarAudience->internship_id);
        $this->assertEquals($student->id, $internshipSeminarAudience->student_id);
        $this->assertEquals($role, $internshipSeminarAudience->role);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $internshipSeminarAudience = InternshipSeminarAudience::factory()->create();

        $response = $this->delete(route('internship-seminar-audiences.destroy', $internshipSeminarAudience));

        $response->assertNoContent();

        $this->assertModelMissing($internshipSeminarAudience);
    }
}
