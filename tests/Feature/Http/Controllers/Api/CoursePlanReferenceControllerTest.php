<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\CoursePlan;
use App\Models\CoursePlanReference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CoursePlanReferenceController
 */
final class CoursePlanReferenceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $coursePlanReferences = CoursePlanReference::factory()->count(3)->create();

        $response = $this->get(route('course-plan-references.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanReferenceController::class,
            'store',
            \App\Http\Requests\CoursePlanReferenceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $course_plan = CoursePlan::factory()->create();
        $title = $this->faker->sentence(4);
        $author = $this->faker->word();
        $publisher = $this->faker->word();
        $year = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->numberBetween(-10000, 10000);
        $primary = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('course-plan-references.store'), [
            'course_plan_id' => $course_plan->id,
            'title' => $title,
            'author' => $author,
            'publisher' => $publisher,
            'year' => $year,
            'type' => $type,
            'primary' => $primary,
        ]);

        $coursePlanReferences = CoursePlanReference::query()
            ->where('course_plan_id', $course_plan->id)
            ->where('title', $title)
            ->where('author', $author)
            ->where('publisher', $publisher)
            ->where('year', $year)
            ->where('type', $type)
            ->where('primary', $primary)
            ->get();
        $this->assertCount(1, $coursePlanReferences);
        $coursePlanReference = $coursePlanReferences->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $coursePlanReference = CoursePlanReference::factory()->create();

        $response = $this->get(route('course-plan-references.show', $coursePlanReference));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\CoursePlanReferenceController::class,
            'update',
            \App\Http\Requests\CoursePlanReferenceUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $coursePlanReference = CoursePlanReference::factory()->create();
        $course_plan = CoursePlan::factory()->create();
        $title = $this->faker->sentence(4);
        $author = $this->faker->word();
        $publisher = $this->faker->word();
        $year = $this->faker->numberBetween(-10000, 10000);
        $type = $this->faker->numberBetween(-10000, 10000);
        $primary = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('course-plan-references.update', $coursePlanReference), [
            'course_plan_id' => $course_plan->id,
            'title' => $title,
            'author' => $author,
            'publisher' => $publisher,
            'year' => $year,
            'type' => $type,
            'primary' => $primary,
        ]);

        $coursePlanReference->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($course_plan->id, $coursePlanReference->course_plan_id);
        $this->assertEquals($title, $coursePlanReference->title);
        $this->assertEquals($author, $coursePlanReference->author);
        $this->assertEquals($publisher, $coursePlanReference->publisher);
        $this->assertEquals($year, $coursePlanReference->year);
        $this->assertEquals($type, $coursePlanReference->type);
        $this->assertEquals($primary, $coursePlanReference->primary);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $coursePlanReference = CoursePlanReference::factory()->create();

        $response = $this->delete(route('course-plan-references.destroy', $coursePlanReference));

        $response->assertNoContent();

        $this->assertModelMissing($coursePlanReference);
    }
}
