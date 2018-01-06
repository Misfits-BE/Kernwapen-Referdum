<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\City;

class NotitionBackendTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of eeen gebruiker de notitie creatie weergave kan benaderen zonder errors 
     */
    public function createWeergaveSuccess() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.notition.create', factory(City::class)->create()))
            ->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test de error response als een niet aangemelde gebruiker de creatie weergave wilt aanroepen. 
     */
    public function createWeergaveNoAuth() 
    {
        $this->get(route('admin.notition.create', factory(City::class)->create()))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test de error response wanneer we een notitie willen creeren voor een stad die niet bestaat.
     */
    public function createWeergaveWrongId() 
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.notition.create', ['id' => 1000]))
            ->assertStatus(404);
    }
}
