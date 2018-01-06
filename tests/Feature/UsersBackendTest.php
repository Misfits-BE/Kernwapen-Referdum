<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersBackendTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox Test de error code als een niet ingelogde gebruiker d users cockpit probeerd te benaderen. 
     */
    public function indexNoAuth() 
    {
        $this->get(route('admin.users.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test of een aangemelde gebruiker de cockpit zonder fouten kan zien. 
     */
    public function indexSuccess() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test of een niet aangemelde gebruiker de creatie user weergave niet kan zien. 
     */
    public function createWeergaveNoAUth() 
    {
        $this->get(route('admin.users.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test of een aangemelde gebruiker zonder fouten de user management console kan zien. 
     */
    public function createWeergaveSuccess()
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test of een niet aangemelde gebruiker bhij een delete operatie word doorverwezen naar login pagina. 
     */
    public function verwijderNoAuth() 
    {

    } 

    /**
     * @test 
     * @testdox Test de response wanneer een gebruiker met ongeldige id word verwijderd. 
     */
    public function verwijderWrongId() 
    {

    }

    /**
     * @test 
     * @testdox Test of een gebruiker successvol een aangemelde gebruiker kan verwijderen. 
     */
    public function verwijderSuccess() 
    {

    }
}
