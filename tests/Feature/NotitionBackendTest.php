<?php

namespace Tests\Feature;

use App\City;
use App\Notitions;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotitionBackendTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of eeen gebruiker de notitie creatie weergave kan benaderen zonder errors
     */
    public function createWeergaveSuccess(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.notition.create', factory(City::class)->create()))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test de error response als een niet aangemelde gebruiker de creatie weergave wilt aanroepen.
     */
    public function createWeergaveNoAuth(): void
    {
        $this->get(route('admin.notition.create', factory(City::class)->create()))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de error response wanneer we een notitie willen creeren voor een stad die niet bestaat.
     */
    public function createWeergaveWrongId(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.notition.create', ['id' => 1000]))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testox Test of een niet aangemelde gebruiker een notitie kan aanmaken.
     */
    public function opslagNotitieNoAuth(): void
    {
        $this->post(route('admin.notition.store', factory(City::class)->create()), [])
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de response wanneer met success een test word aangemaakt in het systeem.
     */
    public function opslagNotitieSuccess(): void
    {
        $city  = factory(City::class)->create();
        $user  = factory(User::class)->create();
        $input = ['titel' => 'Ik ben een titel', 'status' => 1, 'beschrijving' => 'Ik ben een beschrijving'];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('admin.notition.store', $city), $input)
            ->assertStatus(302)
            ->assertRedirect(route('admin.stadsmonitor.show', $city))
            ->assertSessionHas([
                $this->flashSession . '.message' => trans('flash.notitons.store', ['name' => $city->name]),
                $this->flashSession . '.level'   => 'success',
            ]);

        $this->assertDatabaseHas('notitions', $input);
        $this->assertDatabaseHas('activity_log', [
            'subject_id' => $user->id, 'description' => "heeft een notitie toegevoegd voor de stad {$city->name}"
        ]);
    }

    /**
     * @test
     * @testdox Test de response wanneer we een notitie proberen op te slaan onder een niet bestaande stad.
     */
    public function opslagNotitieWrongId(): void
    {
        $user  = factory(User::class)->create();
        $input = ['titel' => 'Ik ben een titel', 'status' => 1, 'beschrijving' => 'Ik ben een beschrijving'];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('admin.notition.store', ['id' => 1000]), $input)
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test of er fouten terug komen als men het notitie formulier incorrect heeft ingevuld.
     */
    public function opslagNotitieValidatieFouten(): void
    {
        $user = factory(User::class)->create();
        $city = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('admin.notition.store', $city), [])
            ->assertStatus(302)
            ->assertSessionHasErrors()
            ->assertSessionMissing([
                $this->flashSession . '.message' => "De notitie voor de stad '{$city->name}' is toegevoegd.",
                $this->flashSession . '.level'   => 'success',
            ]);
    }

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker geen notitie kan verwijderen.
     */
    public function notitieDeleteNoAuth(): void
    {
        $notitie = factory(Notitions::class)->create();
        $city    = factory(City::class)->create();

        $this->get(route('admin.notition.delete', ['notition' => $notitie->id, 'city' => $city->id]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @textdox Test de error response wanneer men een notitie verwijderd met de verkeerde id.
     */
    public function notitieDeleteWrongId(): void
    {
        $user = factory(User::class)->create();
        $city = factory(City::class)->create();
    
        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.notition.delete', ['notition' => 100, 'city' => $city->id]))
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test of een login een notitie kan verwijderen zonder fouten.
     */
    public function notitieDeleteSuccess(): void
    {
        $user       = factory(user::class)->create();
        $city       = factory(City::class)->create();
        $notition   = factory(Notitions::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.notition.delete', ['notition' => $notition->id, 'city' => $city->id]))
            ->assertStatus(302)
            ->assertRedirect(route('admin.stadsmonitor.show', $city))
            ->assertSessionHas([
                $this->flashSession . '.message' => trans('flash.notition.delete'),
                $this->flashSession . '.level'   => 'success'
            ]);

        $this->assertDatabaseMissing('notitions', ['id' => $notition->id]);
        $this->assertDatabaseHas('activity_log', [
            'description' => "Heeft een notitie verwijderd voor de stad {$city->name}"
        ]);
    }
}
