<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\InternshipCompany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\InternshipCompanyController
 */
final class InternshipCompanyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $internshipCompanies = InternshipCompany::factory()->count(3)->create();

        $response = $this->get(route('internship-companies.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipCompanyController::class,
            'store',
            \App\Http\Requests\InternshipCompanyStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $address = $this->faker->text();

        $response = $this->post(route('internship-companies.store'), [
            'name' => $name,
            'address' => $address,
        ]);

        $internshipCompanies = InternshipCompany::query()
            ->where('name', $name)
            ->where('address', $address)
            ->get();
        $this->assertCount(1, $internshipCompanies);
        $internshipCompany = $internshipCompanies->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $internshipCompany = InternshipCompany::factory()->create();

        $response = $this->get(route('internship-companies.show', $internshipCompany));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\InternshipCompanyController::class,
            'update',
            \App\Http\Requests\InternshipCompanyUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $internshipCompany = InternshipCompany::factory()->create();
        $name = $this->faker->name();
        $address = $this->faker->text();

        $response = $this->put(route('internship-companies.update', $internshipCompany), [
            'name' => $name,
            'address' => $address,
        ]);

        $internshipCompany->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $internshipCompany->name);
        $this->assertEquals($address, $internshipCompany->address);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $internshipCompany = InternshipCompany::factory()->create();

        $response = $this->delete(route('internship-companies.destroy', $internshipCompany));

        $response->assertNoContent();

        $this->assertModelMissing($internshipCompany);
    }
}
