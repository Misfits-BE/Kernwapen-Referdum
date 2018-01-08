<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     * @testdox Test of de frontend index pagina succesvol kan renderen.
     */
    public function frontendIndex(): void
    {
        $this->get(route('frontend.index'))->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of de backend index page successvol kan renderen
     */
    public function backendIndex(): void
    {
        $user = factory(User::class)->create();
        
        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('backend.index'))
            ->assertStatus(200);
    }
}
