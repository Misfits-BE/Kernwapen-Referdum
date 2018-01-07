<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     * @testdox Test of de frontend index pagina succesvol kan renderen.
     */
    public function frontendIndex()
    {
        $this->get(route('frontend.index'))->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test of de backend index page successvol kan renderen 
     */
    public function backendIndex() 
    {
        $user = factory(User::class)->create(); 
        
        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('backend.index'))
            ->assertStatus(200);
    }
}
