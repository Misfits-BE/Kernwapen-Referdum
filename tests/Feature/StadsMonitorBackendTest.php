<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

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
}
