<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GithubHookTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @test 
     * @testdox Tess dat een niet aangemelde gebruiker de hookj kan gebruiken of niet.
     */
    public function testBugCreateGeenAuthencatie() 
    {
        $this->get(route('bug.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test dat een gebruiker de giçthub (meld een probleem) hook zijn creatie weergave kan zien.
     */
    public function testBugCreateAuthencatie() 
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->assertAuthenticatedAs($user)
            ->get(route('bug.create'))->assertStatus(200);
    }
}
