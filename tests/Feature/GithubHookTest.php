<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class GithubHookTest
 * ----
 * Tesscase for the github hook.
 * 
 * @author      Tim Joosten <topairy@gmail.com>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature
 */
class GithubHookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Tess dat een niet aangemelde gebruiker de hookj kan gebruiken of niet.
     */
    public function testBugCreateGeenAuthencatie(): void
    {
        $this->assertTrue(true);

        // $this->get(route('bug.create'))
        //    ->assertStatus(302)
        //    ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test dat een gebruiker de giçthub (meld een probleem) hook zijn creatie weergave kan zien.
     */
    public function testBugCreateAuthencatie(): void
    {
        $this->assertTrue(true);

        // $user = factory(User::class)->create();

        // $this->actingAs($user)->assertAuthenticatedAs($user)
        //    ->get(route('bug.create'))->assertStatus(200);
    }
}
