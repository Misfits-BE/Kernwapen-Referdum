<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use App\User;

/**
 * Class StoreTest
 * ----
 * PHPUnit testsuire voor het testen van de opslag bij nieuwe gebruikers.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Users
 */
class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox test de HTTP/1 codd en doorverwijzing wanneer de gebruiker niet is aangemeld.
     */
    public function nietAangemeld(): void
    {
        $input = []; 

        $this->post(route('admin.users.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test if de geauthenceerde gebruiker een gebruiker kan aanmaken.
     */
    public function success(): void
    {
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create();
        $input = ['name' => 'Firstname Lastname', 'role' => $role->name, 'email' => 'test@domain.tld'];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas([
                $this->flashSession . '.message'   => trans('flash.users.store', ['name' => $input['name']]), 
                $this->flashSession . '.level'     => 'success', 
                $this->flashSession . '.important' => true,
            ]);

            $this->assertDatabaseHas('users', ['name' => 'Firstname Lastname', 'email' => 'test@domain.tld']);
    }

    /**
     * @test
     * @testdox Test of de naam in het formulier vereist is.
     */
    public function validatieRequiredNaam(): void
    {
        $role  = factory(Role::class)->create();
        $user  = factory(User::class)->create();
        $input = ['role' => $role->name, 'email' => 'test@domain.tld'];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['name' => trans('validation.required', ['attribute' => 'naam'])]);
    }

    /**
     * @test
     * @testdox Test de maximum lengte van de naam die de gebruiker kan opgeven.
     */
    public function validatieMaxNaam(): void
    {
        $role  = factory(Role::class)->create(); 
        $user  = factory(User::class)->create(); 
        $input = ['role' => $role->name, 'email' => 'test@domain.tld', 'name' => str_random(275)];
        
        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors([
                'name' => trans('validation.max.string', ['attribute' => 'naam', 'max' => 255])
            ]);
    }

    /**
     * @test
     * @testdox Test dof de waarde van het naam veld een string moet zijn. 
     */
    public function validationStringNaam(): void
    {
        $user  = factory(User::class)->create();
        $role  = factory(Role::class)->create(); 
        $input = ['name' => rand(0, 10), 'email' => 'test@domain.tld', 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['name' => trans('validation.string', ['attribute' => 'naam'])]);
    }

    /**
     * @test
     * @testdox Test of de waarde van het veld gebruikers rol vereist is. 
     */
    public function validatieRequiredRol(): void
    {
        $user  = factory(User::class)->create(); 
        $input = ['name' => 'Firstname Lastname', 'email' => 'test@domain.tld'];
        
        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['role' => trans('validation.required', ['attribute' => 'role'])]);
    }

    /**
     * @test
     * @testdox Test of de waarde in de gebruikers permissie dropdown een string is. 
     */
    public function validatieStringRol(): void
    {
        $role  = factory(Role::class)->create(['name' => rand(0, 9)]); 
        $user  = factory(User::class)->create();
        $input = ['name' => 'Firstname Lastname', 'email' => 'test@domain.tld', 'role' => $role->name];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['role' => trans('validation.string', ['attribute' => 'role'])]);
    }

    /**
     * @test
     * @testdox Test validatie voor de maximum lengte van de gebruikersrol. 
     */
    public function validatieMaxRol(): void
    {
        $role  = factory(Role::class)->create(['name' => str_random(275)]);
        $user  = factory(User::class)->create();
        $input = ['name' => 'Firstname Lastname', 'email' => 'test@domain.tld', 'role' => $role->name]; 
        
        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors([
                'role' => trans('validation.max.string', ['attribute' => 'role', 'max' => 255])
            ]);
    }

    /**
     * @test
     * @testdox Test dat het email veld vereist is. 
     */
    public function validatieEmailRequired(): void
    {
        $user  = factory(User::class)->create();
        $role  = factory(Role::class)->create();
        $input = ['name' => 'Firstname Lastname', 'role' => $role->name];
        
        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['email' => trans('validation.required', ['attribute' => 'e-mailadres'])]);
    }

    /**
     * @test
     * @testdox Test of de waarde in het email veld een unieke waarde is in de databank.
     */
    public function validatieEmailUnique(): void
    {
        $user  = factory(User::class)->create();
        $role  = factory(Role::class)->create(); 
        $input = ['name' => 'Firstname Lastname', 'role' => $role->name, 'email' => $user->email];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['email' => trans('validation.unique', ['attribute' => 'e-mailadres'])]);
    }

    /**
     * @test
     * @testdox Validatie check dat een email adres wel effectief een email adres is.
     */
    public function validatieEmailString(): void
    {
        $user   = factory(User::class)->create();
        $role   = factory(Role::class)->create();
        $input  = ['name' => 'Firstname Lastname', 'role' => $role->name, 'email' => rand(0, 10)];

        $this->actingAs($user)
            ->post(route('admin.users.store'), $input)
            ->assertSessionHasErrors(['email' => trans('validation.string', ['attribute' => 'e-mailadres'])]);
    }
}
