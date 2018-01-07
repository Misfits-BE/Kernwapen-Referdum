<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LogoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test 
     * @testdox Test dat de gebruiker naar de login page word geleid omdat er niets uit te loggen valt.
     */
    public function logOutGeenGebruiker() 
    {
        $this->assertFalse($this->isAuthenticated());
        $this->post(route('logout'))->assertStatus(302)
            ->assertRedirect(url('/'));
    }

    /**
     * @test 
     * @testdox Test dat de gebruiker effectief word uitgelogd.
     */
    public function testLogoutFunctieSuccess() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('logout'))
            ->assertStatus(302); 

        $this->assertFalse($this->isAuthenticated());
    }
}
