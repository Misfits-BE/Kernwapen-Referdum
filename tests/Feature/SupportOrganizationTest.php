<?php

namespace Tests\Feature;

use App\Support;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class SupportOrganizationTest
 * ---- 
 * Tests for the organization support system in the application. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature
 */
class SupportOrganizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een gast de ondersteunings pagina zonder problemen kan bekijken.
     */
    public function testFrontEndPagina(): void
    {
        factory(Support::class, 5)->create();
        $this->get(route('support.index'))->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test dat een niet aangemelde gebruiker word omgeleid naar de login pagina.
     */
    public function indexWeergaveNoAuth(): void
    {
        $this->get(route('admin.support.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test dat een aangemelde gebruiker de index pagina kan bekijken zonder fouten.
     */
    public function indexWeergaveSuccess(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.support.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test dat een niet aangemelde gebruiker word omgeleid naar de login pagina.
     */
    public function createWeergaveNoAuth(): void
    {
        $this->get(route('admin.support.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test dat een aangemelde gebruiker de organisatie creatie pagina kan bekijken zonder fouten.
     */
    public function createWeergaveSuccess(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.support.create'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test dat een niet aangemelde gebruiker word omgeleid naar de login pagina.
     */
    public function organisatieVerwijderNoAuth(): void
    {
        $organisation = factory(Support::class)->create();

        $this->get(route('admin.support.delete', $organisation))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de error response wanneer een foutieve id word gegeven (organisatie verwijder)
     */
    public function organisatieVerwijderWrongId(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get('admin.support.delete', ['id' => 10000])
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test of een aangemelde gebruiker effectief een ondersteunende organisatie kan verwijderen.
     */
    public function organisatieVerwijderSuccess(): void
    {
        $user         = factory(User::class)->create();
        $organisation = factory(Support::class)->create();
        
        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.support.delete', $organisation))
            ->assertSessionHas([
                $this->flashSession . '.message' => 'De ondersteunende organisatie is verwijder.',
                $this->flashSession . '.level'   => 'success'
            ]);

        $this->assertDatabaseMissing('supports', ['id' => $organisation->id]);
    }

    /**
     * @test
     * @testdox Test of een gast gebruiker een organisatie niet kan invoegen in het systeem.
     */
    public function organisatieOpslaanNoAuth(): void
    {
        $input = [
            'name' => 'Misfits', 'link' => 'https://www.example.tld', 'telefoon_nr' => '0000/00 00 000',
            'verantwoordelijke_email' => 'name@domain.tld', 'verantwoordelijke_naam' => 'John Doe'
        ];

        $this->post(route('admin.support.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test of er validatie errors worden gesmeten als een gebruiker het formulier incorrect invult.
     */
    public function organisatieOpslaanValidationErrors(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('admin.support.store'), [])
            ->assertStatus(302)
            ->assertSessionHasErrors()
            ->assertSessionMissing([
                $this->flashSession . '.message' => 'De ondersteunende organisatie is toegevoegd aan het systeem.',
                $this->flashSession . '.level'   => 'success'
            ]);
    }

    /**
     * @test
     * @testdox Check of een gebruiker een ondersteundende organisatie kan toevoegen zonder problemen.
     */
    public function organisatieOpslaanSuccess(): void
    {
        $user  = factory(User::class)->create();
        $input = [
            'name' => 'Misfits', 'link' => 'https://www.example.tld', 'telefoon_nr' => '0000/00 00 000',
            'verantwoordelijke_email' => 'name@domain.tld', 'verantwoordelijke_naam' => 'John Doe'
        ];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('admin.support.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('admin.support.index'))
            ->assertSessionHas([
                $this->flashSession . '.message' => 'De ondersteunende organisatie is toegevoegd aan het systeem.',
                $this->flashSession . '.level'   => 'success'
            ]);

        $this->assertDatabaseHas('supports', $input);
    }
}
