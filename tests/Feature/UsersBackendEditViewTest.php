<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

/**
 * Class usersBackendEditViewTest 
 * ---- 
 * PHPUnit testsuite voor de edit weergave van een gebruikers account. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature
 */
class UsersBackendEditViewTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test
     * @testdox De verwijziging en HTTP/1 status code wanneer de gebruiker niet is aangemeld. 
     */
    public function nietAangemeld(): void 
    {
        $user = factory(User::class)->create();

        $this->get(route('admin.users.edit', $user))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de HTTP/1 status wanneer er geen gebruiker word gevonden.
     */
    public function foutieveId(): void 
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.users.edit',  ['id' => rand(0, 250)]))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test dat men een gebruiker kan aanpassen zonder fouten.
     */
    public function success(): void 
    {
        factory(Role::class)->create(); 
        $user = factory(User::class, 2)->create();

        $this->actingAs($user[0])
            ->get(route('admin.users.edit', $user[1]))
            ->assertStatus(200);
    }
}
