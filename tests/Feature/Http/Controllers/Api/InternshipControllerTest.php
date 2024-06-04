<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Internship;
use App\Models\InternshipProposal;
use App\Models\Lecturer;
use App\Models\SeminarRoom;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\InternshipController
 */
final class InternshipControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $internships = Internship::factory()->count(3)->create();

        $response = $this->get(route('internships.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipController::class,
            'store',
            \App\Http\Requests\InternshipStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $internship_proposal = InternshipProposal::factory()->create();
        $student = Student::factory()->create();
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $start_at = Carbon::parse($this->faker->date());
        $seminar_room = SeminarRoom::factory()->create();
        $lecturer = Lecturer::factory()->create();

        $response = $this->post(route('internships.store'), [
            'internship_proposal_id' => $internship_proposal->id,
            'student_id' => $student->id,
            'status' => $status,
            'start_at' => $start_at->toDateString(),
            'seminar_room_id' => $seminar_room->id,
            'lecturer_id' => $lecturer->id,
        ]);

        $internships = Internship::query()
            ->where('internship_proposal_id', $internship_proposal->id)
            ->where('student_id', $student->id)
            ->where('status', $status)
            ->where('start_at', $start_at)
            ->where('seminar_room_id', $seminar_room->id)
            ->where('lecturer_id', $lecturer->id)
            ->get();
        $this->assertCount(1, $internships);
        $internship = $internships->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $internship = Internship::factory()->create();

        $response = $this->get(route('internships.show', $internship));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipController::class,
            'update',
            \App\Http\Requests\InternshipUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $internship = Internship::factory()->create();
        $internship_proposal = InternshipProposal::factory()->create();
        $student = Student::factory()->create();
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $start_at = Carbon::parse($this->faker->date());
        $seminar_room = SeminarRoom::factory()->create();
        $lecturer = Lecturer::factory()->create();

        $response = $this->put(route('internships.update', $internship), [
            'internship_proposal_id' => $internship_proposal->id,
            'student_id' => $student->id,
            'status' => $status,
            'start_at' => $start_at->toDateString(),
            'seminar_room_id' => $seminar_room->id,
            'lecturer_id' => $lecturer->id,
        ]);

        $internship->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($internship_proposal->id, $internship->internship_proposal_id);
        $this->assertEquals($student->id, $internship->student_id);
        $this->assertEquals($status, $internship->status);
        $this->assertEquals($start_at, $internship->start_at);
        $this->assertEquals($seminar_room->id, $internship->seminar_room_id);
        $this->assertEquals($lecturer->id, $internship->lecturer_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $internship = Internship::factory()->create();

        $response = $this->delete(route('internships.destroy', $internship));

        $response->assertNoContent();

        $this->assertModelMissing($internship);
    }
}
