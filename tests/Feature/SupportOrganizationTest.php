<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Support;

class SupportOrganizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test 
     * @testdox Test of een gast de ondersteunings pagina zonder problemen kan bekijken.
     */
    public function testFrontEndPagina()
    {
        factory(Support::class, 5)->create(); 
        $this->get(route('support.index'))->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test dat een niet aangemelde gebruiker word omgeleid naar de login pagina.
     */
    public function indexWeergaveNoAuth() 
    {
        $this->get(route('admin.support.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test dat een aangemelde gebruiker de index pagina kan bekijken zonder fouten.
     */
    public function indexWeergaveSuccess() 
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
    public function createWeergaveNoAuth() 
    {
        $this->get(route('admin.support.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test dat een aangemelde gebruiker de organisatie creatie pagina kan bekijken zonder fouten. 
     */
    public function createWeergaveSuccess()
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
    public function organisatieVerwijderNoAuth() 
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
    public function organisatieVerwijderWrongId() 
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
    public function organisatieVerwijderSuccess() 
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
    public function organisatieOpslaanNoAuth()
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
    public function organisatieOpslaanValidationErrors() 
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
    public function organisatieOpslaanSuccess() 
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
