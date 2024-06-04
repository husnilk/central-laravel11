<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Company;
use App\Models\InternshipCompany;
use App\Models\InternshipProposal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\InternshipProposalController
 */
final class InternshipProposalControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $internshipProposals = InternshipProposal::factory()->count(3)->create();

        $response = $this->get(route('internship-proposals.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipProposalController::class,
            'store',
            \App\Http\Requests\InternshipProposalStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $company = Company::factory()->create();
        $type = $this->faker->numberBetween(-10000, 10000);
        $title = $this->faker->sentence(4);
        $start_at = Carbon::parse($this->faker->date());
        $end_at = Carbon::parse($this->faker->date());
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $active = $this->faker->numberBetween(-10000, 10000);
        $internship_company = InternshipCompany::factory()->create();

        $response = $this->post(route('internship-proposals.store'), [
            'company_id' => $company->id,
            'type' => $type,
            'title' => $title,
            'start_at' => $start_at->toDateString(),
            'end_at' => $end_at->toDateString(),
            'status' => $status,
            'active' => $active,
            'internship_company_id' => $internship_company->id,
        ]);

        $internshipProposals = InternshipProposal::query()
            ->where('company_id', $company->id)
            ->where('type', $type)
            ->where('title', $title)
            ->where('start_at', $start_at)
            ->where('end_at', $end_at)
            ->where('status', $status)
            ->where('active', $active)
            ->where('internship_company_id', $internship_company->id)
            ->get();
        $this->assertCount(1, $internshipProposals);
        $internshipProposal = $internshipProposals->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $internshipProposal = InternshipProposal::factory()->create();

        $response = $this->get(route('internship-proposals.show', $internshipProposal));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipProposalController::class,
            'update',
            \App\Http\Requests\InternshipProposalUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $internshipProposal = InternshipProposal::factory()->create();
        $company = Company::factory()->create();
        $type = $this->faker->numberBetween(-10000, 10000);
        $title = $this->faker->sentence(4);
        $start_at = Carbon::parse($this->faker->date());
        $end_at = Carbon::parse($this->faker->date());
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $active = $this->faker->numberBetween(-10000, 10000);
        $internship_company = InternshipCompany::factory()->create();

        $response = $this->put(route('internship-proposals.update', $internshipProposal), [
            'company_id' => $company->id,
            'type' => $type,
            'title' => $title,
            'start_at' => $start_at->toDateString(),
            'end_at' => $end_at->toDateString(),
            'status' => $status,
            'active' => $active,
            'internship_company_id' => $internship_company->id,
        ]);

        $internshipProposal->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($company->id, $internshipProposal->company_id);
        $this->assertEquals($type, $internshipProposal->type);
        $this->assertEquals($title, $internshipProposal->title);
        $this->assertEquals($start_at, $internshipProposal->start_at);
        $this->assertEquals($end_at, $internshipProposal->end_at);
        $this->assertEquals($status, $internshipProposal->status);
        $this->assertEquals($active, $internshipProposal->active);
        $this->assertEquals($internship_company->id, $internshipProposal->internship_company_id);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $internshipProposal = InternshipProposal::factory()->create();

        $response = $this->delete(route('internship-proposals.destroy', $internshipProposal));

        $response->assertNoContent();

        $this->assertModelMissing($internshipProposal);
    }
}
