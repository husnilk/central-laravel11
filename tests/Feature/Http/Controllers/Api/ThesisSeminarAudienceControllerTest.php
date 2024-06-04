<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Student;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisSeminarAudienceController
 */
final class ThesisSeminarAudienceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesisSeminarAudiences = ThesisSeminarAudience::factory()->count(3)->create();

        $response = $this->get(route('thesis-seminar-audiences.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisSeminarAudienceController::class,
            'store',
            \App\Http\Requests\ThesisSeminarAudienceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $thesis_seminar = ThesisSeminar::factory()->create();
        $student = Student::factory()->create();

        $response = $this->post(route('thesis-seminar-audiences.store'), [
            'thesis_seminar_id' => $thesis_seminar->id,
            'student_id' => $student->id,
        ]);

        $thesisSeminarAudiences = ThesisSeminarAudience::query()
            ->where('thesis_seminar_id', $thesis_seminar->id)
            ->where('student_id', $student->id)
            ->get();
        $this->assertCount(1, $thesisSeminarAudiences);
        $thesisSeminarAudience = $thesisSeminarAudiences->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesisSeminarAudience = ThesisSeminarAudience::factory()->create();

        $response = $this->get(route('thesis-seminar-audiences.show', $thesisSeminarAudience));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisSeminarAudienceController::class,
            'update',
            \App\Http\Requests\ThesisSeminarAudienceUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesisSeminarAudience = ThesisSeminarAudience::factory()->create();
        $thesis_seminar = ThesisSeminar::factory()->create();
        $student = Student::factory()->create();

        $response = $this->put(route('thesis-seminar-audiences.update', $thesisSeminarAudience), [
            'thesis_seminar_id' => $thesis_seminar->id,
            'student_id' => $student->id,
        ]);

        $thesisSeminarAudience->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($thesis_seminar->id, $thesisSeminarAudience->thesis_seminar_id);
        $this->assertEquals($student->id, $thesisSeminarAudience->student_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesisSeminarAudience = ThesisSeminarAudience::factory()->create();

        $response = $this->delete(route('thesis-seminar-audiences.destroy', $thesisSeminarAudience));

        $response->assertNoContent();

        $this->assertModelMissing($thesisSeminarAudience);
    }
}
