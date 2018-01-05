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
}
