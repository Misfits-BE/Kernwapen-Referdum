<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class UsersCreateViewTest
 * ----
 * PHPUnit testsuite voor het testen van de view om gebruikers aan te maken.
 */
class UsersCreateViewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test de HTTP/1 code en doorverwijzing wanneer gebruiker niet is aangemeld.
     */
    public function nietAangemeld(): void
    {
        $this->get(route('admin.users.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test dat de gebruiker de weergave zonder fouten kan benutten.
     */
    public function success(): void
    {
        factory(Role::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.users.create'))
            ->assertStatus(200);
    }
}
