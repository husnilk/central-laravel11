<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CounsellingCategory;
use App\Models\CounsellingLogbook;
use App\Models\CounsellingTopic;
use App\Models\Counsellor;
use App\Models\Period;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CounsellingLogbookController
 */
final class CounsellingLogbookControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $counsellingLogbooks = CounsellingLogbook::factory()->count(3)->create();

        $response = $this->get(route('counselling-logbooks.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CounsellingLogbookController::class,
            'store',
            \App\Http\Requests\CounsellingLogbookStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $student = Student::factory()->create();
        $counsellor = Counsellor::factory()->create();
        $counselling_topic = CounsellingTopic::factory()->create();
        $period = Period::factory()->create();
        $date = Carbon::parse($this->faker->date());
        $status = $this->faker->numberBetween(-10000, 10000);
        $counselling_category = CounsellingCategory::factory()->create();

        $response = $this->post(route('counselling-logbooks.store'), [
            'student_id' => $student->id,
            'counsellor_id' => $counsellor->id,
            'counselling_topic_id' => $counselling_topic->id,
            'period_id' => $period->id,
            'date' => $date->toDateString(),
            'status' => $status,
            'counselling_category_id' => $counselling_category->id,
        ]);

        $counsellingLogbooks = CounsellingLogbook::query()
            ->where('student_id', $student->id)
            ->where('counsellor_id', $counsellor->id)
            ->where('counselling_topic_id', $counselling_topic->id)
            ->where('period_id', $period->id)
            ->where('date', $date)
            ->where('status', $status)
            ->where('counselling_category_id', $counselling_category->id)
            ->get();
        $this->assertCount(1, $counsellingLogbooks);
        $counsellingLogbook = $counsellingLogbooks->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $counsellingLogbook = CounsellingLogbook::factory()->create();

        $response = $this->get(route('counselling-logbooks.show', $counsellingLogbook));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CounsellingLogbookController::class,
            'update',
            \App\Http\Requests\CounsellingLogbookUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $counsellingLogbook = CounsellingLogbook::factory()->create();
        $student = Student::factory()->create();
        $counsellor = Counsellor::factory()->create();
        $counselling_topic = CounsellingTopic::factory()->create();
        $period = Period::factory()->create();
        $date = Carbon::parse($this->faker->date());
        $status = $this->faker->numberBetween(-10000, 10000);
        $counselling_category = CounsellingCategory::factory()->create();

        $response = $this->put(route('counselling-logbooks.update', $counsellingLogbook), [
            'student_id' => $student->id,
            'counsellor_id' => $counsellor->id,
            'counselling_topic_id' => $counselling_topic->id,
            'period_id' => $period->id,
            'date' => $date->toDateString(),
            'status' => $status,
            'counselling_category_id' => $counselling_category->id,
        ]);

        $counsellingLogbook->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($student->id, $counsellingLogbook->student_id);
        $this->assertEquals($counsellor->id, $counsellingLogbook->counsellor_id);
        $this->assertEquals($counselling_topic->id, $counsellingLogbook->counselling_topic_id);
        $this->assertEquals($period->id, $counsellingLogbook->period_id);
        $this->assertEquals($date, $counsellingLogbook->date);
        $this->assertEquals($status, $counsellingLogbook->status);
        $this->assertEquals($counselling_category->id, $counsellingLogbook->counselling_category_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $counsellingLogbook = CounsellingLogbook::factory()->create();

        $response = $this->delete(route('counselling-logbooks.destroy', $counsellingLogbook));

        $response->assertNoContent();

        $this->assertModelMissing($counsellingLogbook);
    }
}
