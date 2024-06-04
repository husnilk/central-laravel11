<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CreatedBy;
use App\Models\Student;
use App\Models\Thesi;
use App\Models\Thesis;
use App\Models\ThesisTopic;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\ThesisController
 */
final class ThesisControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $thesis = Thesis::factory()->count(3)->create();

        $response = $this->get(route('thesis.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisController::class,
            'store',
            \App\Http\Requests\ThesisStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $topic = Topic::factory()->create();
        $student = Student::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $created_by = CreatedBy::factory()->create();
        $thesis_topic = ThesisTopic::factory()->create();
        $user = User::factory()->create();

        $response = $this->post(route('thesis.store'), [
            'topic_id' => $topic->id,
            'student_id' => $student->id,
            'status' => $status,
            'created_by' => $created_by->id,
            'thesis_topic_id' => $thesis_topic->id,
            'user_id' => $user->id,
        ]);

        $thesis = Thesi::query()
            ->where('topic_id', $topic->id)
            ->where('student_id', $student->id)
            ->where('status', $status)
            ->where('created_by', $created_by->id)
            ->where('thesis_topic_id', $thesis_topic->id)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $thesis);
        $thesi = $thesis->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $thesi = Thesis::factory()->create();

        $response = $this->get(route('thesis.show', $thesi));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\ThesisController::class,
            'update',
            \App\Http\Requests\ThesisUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $thesi = Thesis::factory()->create();
        $topic = Topic::factory()->create();
        $student = Student::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $created_by = CreatedBy::factory()->create();
        $thesis_topic = ThesisTopic::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('thesis.update', $thesi), [
            'topic_id' => $topic->id,
            'student_id' => $student->id,
            'status' => $status,
            'created_by' => $created_by->id,
            'thesis_topic_id' => $thesis_topic->id,
            'user_id' => $user->id,
        ]);

        $thesi->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($topic->id, $thesi->topic_id);
        $this->assertEquals($student->id, $thesi->student_id);
        $this->assertEquals($status, $thesi->status);
        $this->assertEquals($created_by->id, $thesi->created_by);
        $this->assertEquals($thesis_topic->id, $thesi->thesis_topic_id);
        $this->assertEquals($user->id, $thesi->user_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $thesi = Thesis::factory()->create();
        $thesi = Thesi::factory()->create();

        $response = $this->delete(route('thesis.destroy', $thesi));

        $response->assertNoContent();

        $this->assertModelMissing($thesi);
    }
}
