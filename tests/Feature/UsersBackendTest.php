<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersBackendTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test de error code als een niet ingelogde gebruiker d users cockpit probeerd te benaderen.
     */
    public function indexNoAuth(): void
    {
        $this->get(route('admin.users.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test of een aangemelde gebruiker de cockpit zonder fouten kan zien.
     */
    public function indexSuccess(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker de creatie user weergave niet kan zien.
     */
    public function createWeergaveNoAUth(): void
    {
        $this->get(route('admin.users.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test of een aangemelde gebruiker zonder fouten de user management console kan zien.
     */
    public function createWeergaveSuccess(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.users.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker bhij een delete operatie word doorverwezen naar login pagina.
     */
    public function verwijderNoAuth(): void
    {
        $user = factory(User::class)->create();

        $this->get(route('admin.users.delete', $user))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de response wanneer een gebruiker met ongeldige id word verwijderd.
     */
    public function verwijderWrongId(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.users.delete', ['id' => 1234]))
            ->assertStatus(302)
            ->assertSessionMissing([
                $this->flashSession . '.message' => 'De gebruiker is verwijderd uit het systeem.',
                $this->flashSession . '.level'   => 'success'
            ]);
    }

    /**
     * @test
     * @testdox Test of een gebruiker successvol een aangemelde gebruiker kan verwijderen.
     */
    public function verwijderSuccess(): void
    {
        $user = factory(User::class, 2)->create();

        $this->actingAs($user[0])
            ->assertAuthenticatedAs($user[0])
            ->get(route('admin.users.delete', $user[1]))
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => 'De gebruiker is verwijderd uit het systeem.',
                $this->flashSession . '.level'   => 'success'
            ]);

        $this->assertDatabaseMissing('users', ['id' => $user[1]->id]);
    }
}
