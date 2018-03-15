<?php

namespace Tests\Feature;

use App\User;
use Gate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Misfits\ApiGuard\Models\ApiKey;
use Tests\TestCase;

/**
 * Class ApiKeyTest
 * ----
 * PHPunit testsuite voor het testing van de API token management (opslag, verwijderen, re-generatie)
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature
 */
class ApiKeyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox API token probeer te hergenereren wanneer niet aangemeld
     */
    public function apiTokenHergenereerNietAangemeld(): void
    {
        $token = factory(ApiKey::class)->create();

        $this->get(route('admin.apikey.regenerate', $token->id))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox API Token hergenereer token met foutieve identifier
     */
    public function apiTokenHergenereerFoutieveId(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.apikey.regenerate', ['id' => rand(0, 150)]))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox API Token hergenereer success
     */
    public function apiTokenHergenereerSuccess(): void
    {
        $user  = factory(User::class)->create();
        $token = factory(ApiKey::class)->create();
        
        Gate::before(function (): bool {
            return true;
        });

        $this->actingAs($user)
            ->get(route('admin.apikey.regenerate', $token->id))
            ->assertStatus(302)
            ->assertRedirect(route('account.settings', ['type' => 'tokens']))
            ->assertSessionHas([
                $this->flashSession . '.message'   => trans('flash.apikeys.regenerate', ['service' => $input['service']]),
                $this->flashSession . '.level'     => 'success',
                $this->flashSession . '.important' => true,
            ]);
    }

    /**
     * @test
     * @testdox Probeer een api token aan te maken wanneer de gebruiken niet is ingelogd.
     */
    public function apiTokenAanmakenNietAangemeld(): void
    {
        $this->post(route('admin.apikey.store'), ['service' => 'PHPUnit service'])
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test het aanmaken van een API token wanneer het formulier foutief word ingevult.
     */
    public function apiTokenAanmakenValidatieFoutenVereist(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post(route('admin.apikey.store'), []) //? Lege array wegen geen invoer (Service naam)
            ->assertSessionHasErrors(['service' => trans('validation.required', ['attribute' => 'service'])]);
    }

    /**
     * @test
     * @testdox Test de validatie fouten wanneer de service naam een nummerieke waarden is.
     */
    public function apiTokenAanmakenValidatieFoutenNumeriekeWaarden(): void
    {
        $user  = factory(User::class)->create();
        $input = ['service' => rand(0, 100000)];

        $this->actingAs($user)
            ->post(route('admin.apikey.store'), $input)
            ->assertSessionHasErrors(['service' => trans('validation.string', ['attribute' => 'service'])]);
    }

    /**
     * @test
     * @testdox Test de validatie fouten wanneer de service naam te lang is.
     */
    public function apiTokenAanmakenValidatieFoutennaamTeLang()
    {
        $user  = factory(User::class)->create();
        $input = ['service' => str_random(250)];
        
        $this->actingAs($user)
            ->post(route('admin.apikey.store'), $input)
            ->assertSessionHasErrors([
                'service' => trans('validation.max.string', ['attribute' => 'service', 'max' => 191])
            ]);
    }

    /**
     * @test
     * @testdox Test of een gebruiker zonder problemen een API Token kan aanmaken.
     */
    public function apiTokenAanmakenSucces(): void
    {
        $user  = factory(User::class)->create();
        $input = ['service' => 'phpunit service'];

        $this->assertDatabaseMissing('api_keys', $input);

        $this->actingAs($user)
            ->post(route('admin.apikey.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('account.settings', ['type' => 'tokens']))
            ->assertSessionHas([
                $this->flashSession . '.message'   => trans('flash.apikeys.store', ['service' => $input['service']]),
                $this->flashSession . '.level'     => 'success',
                $this->flashSession . '.important' => true,
            ]);

        $this->assertDatabaseHas('api_keys', $input);
    }

    /**
     * @test
     * @testdox Test het verwijderen van een API Token met een ongeldige databank id.
     */
    public function apiTokenVerwijderOngeldigeId(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.apikey.delete', ['id' => 100000]))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test of het verwijderen van een API token mogelijk is in het systeem.
     */
    public function apiTokenVerwijderSuccess(): void
    {
        $token = factory(ApiKey::class)->create();
        $user  = factory(User::class)->create();

        Gate::before(function (): bool {
            return true;
        });

        $this->actingAs($user)
            ->get(route('admin.apikey.delete', $token->id))
            ->assertStatus(302)
            ->assertRedirect(route('account.settings', ['type' => 'tokens']))
            ->assertSessionHas([
                $this->flashSession . '.message'   => trans('flash.apikeys.delete', ['service' => $token->service]),
                $this->flashSession . '.level'     => 'info',
                $this->flashSession . '.important' => true,
            ]);
    }

    /**
     * @test
     * @testdox Test of het verwijderen van een api token niet mogelijk is wanneer de gebruiker niet is aangemeld.
     */
    public function apiTokenVerwijderNietAangemeld(): void
    {
        $token = factory(ApiKey::class)->create();

        $this->get(route('admin.apikey.delete', $token->id))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
