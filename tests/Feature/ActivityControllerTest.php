<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ActivityControllerTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox Testde error response wanneer een niet aangemelde gebruiker de activiteiten log wilt bekijken. 
     */
    public function indexNoAuth() 
    {
        $this->get(route('admin.logs.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function indexSuccess() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.logs.index'))
            ->assertStatus(200);
    }
}
