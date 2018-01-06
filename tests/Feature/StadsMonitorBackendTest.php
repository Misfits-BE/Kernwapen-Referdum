<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Province;
use App\City;

class StadsMonitorBackendTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox Test dat een niet aangemelde gebruiker word omgeleid naar de login pagina. 
     */
    public function stadsMonitorIndexNoAuth()
    {
        $this->get(route('admin.stadsmonitor.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test dat een aangemelde gebruiker de backend index van de stadsmonitor kan zien zonder errors
     */
    public function stadsMonitorIndexSuccess()
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.stadsmonitor.index'))
            ->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test of de aangemelde gebruiker een specifieke stad kan zien zonder errors 
     */
    public function specifiekeStadWeergaveNoAuth() 
    {
        $user = factory(User::class)->create(); 
        $city = factory(City::class)->create();

        $this->get(route('admin.stadsmonitor.show', $city))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test de error output wanneer een foutieve ID word gegeven. 
     */
    public function specifiekeStadWeergavWrongId() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.stadsmonitor.show', ['id' => 1000]))
            ->assertStatus(404);
    }
    
    /**
     * @test 
     * @testdox Test dat een aangemelde gebruiker een specifieke stads kan zien.
     */
    public function specifiekeStadWeergaveSuccess()
    {
        $user = factory(User::class)->create(); 
        $city = factory(City::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.stadsmonitor.show', $city))
            ->assertStatus(200);
    }
}
