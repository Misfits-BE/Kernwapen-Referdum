<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BanTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox Test de response wanneer we gebruiker die al geband is proberen te bannen. 
     */
    public function banAlreadyBanned() 
    {
        $users    = factory(User::class, 2)->create(); 
        $username = $users[1]->name;

        User::find($users[1]->id)->ban();

        $this->actingAs($users[0])
            ->assertAuthenticatedAs($users[0])
            ->get(route('admin.users.lock', $users[1]))
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => "Helaas! Er is iets misgelopen. :(",
                $this->flashSession . '.level'   => 'warning'
            ]);
    }

    /**
     * @test 
     * @testdox Test of we zonder fouten een gebruiker kunnen blokkeren. 
     */
    public function banSuccess() 
    {
        $user = factory(User::class, 2)->create();
        $username = $user[1]->name; 

        $this->actingAs($user[0])
            ->assertAuthenticatedAs($user[0])
            ->get(route('admin.users.lock', $user[1]))
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => "{$username} is geblokkeerd in the systeem.",
                $this->flashSession . '.level'   => 'danger'
            ]);
    }

    /**
     * @test 
     * @test Test de response wanneer we een gebruiker die al actief is nog is proberen te activeren.
     */
    public function unbanAlreadyUnbanned() 
    {
        $users = factory(User::class, 2)->create(); 

        $this->actingAs($users[0])
            ->assertAuthenticatedAs($users[0])
            ->get(route('admin.users.active', $users[1]))
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => "Helaas! Er is iets misgelopen. :(", 
                $this->flashSession . '.level'   => 'warning'
            ]);
    }

    /**
     * @test 
     * @testdox Test de response wanneer we succesvol een gebruiker hebben geactiveerd. 
     */
    public function unbanSuccess() 
    {
        $users    = factory(User::class, 2)->create();
        $username = $users[1]->name;

        User::find($users[1]->id)->ban();
        
        $this->actingAs($users[0])
            ->assertAuthenticatedAs($users[0])
            ->get(route('admin.users.active', $users[1]))
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => "{$username} is terug actief in het systeem.", 
                $this->flashSession . '.level'   => 'success'
            ]);
    }

    /**
     * @test 
     * @testdox Test de error respons wanneer een gebruiker met niet bestaande id bannen. 
     */
    public function banWrongId() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.users.lock', ['id' => 10000]))
            ->assertStatus(404);
    }

    /**
     * @test 
     * @testdox Test o)f een niet aangemelde gebruiker een andere gebruiker kan blokkeren
     */
    public function banNoAuth() 
    {
        $user = factory(User::class)->create();

        $this->get(route('admin.users.lock', $user))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test de response wanneer een gebruiker met verkeerde id proberen te activeren. 
     */
    public function unbanWrongId() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.users.active', ['id' => 10000]))
            ->assertStatus(404);
    }

    /**
     * @test 
     * @testdox Test of een niet aangemelde gebruiker een andere gebruiker kan activeren.
     */
    public function unbanNoAuth() 
    {
        $user = factory(User::class)->create()->ban();

        $this->get(route('admin.users.active', $user))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
