<?php

namespace Tests\Feature;

use App\City;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StadsMonitorBackendTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test dat een niet aangemelde gebruiker word omgeleid naar de login pagina.
     */
    public function stadsMonitorIndexNoAuth(): void
    {
        $this->get(route('admin.stadsmonitor.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test dat een aangemelde gebruiker de backend index van de stadsmonitor kan zien zonder errors
     */
    public function stadsMonitorIndexSuccess(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.stadsmonitor.index'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of de aangemelde gebruiker een specifieke stad kan zien zonder errors
     */
    public function specifiekeStadWeergaveNoAuth(): void
    {
        $user = factory(User::class)->create();
        $city = factory(City::class)->create();

        $this->get(route('admin.stadsmonitor.show', $city))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test de error output wanneer een foutieve ID word gegeven.
     */
    public function specifiekeStadWeergavWrongId(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.stadsmonitor.show', ['id' => 1000]))
            ->assertStatus(404);
    }
    
    /**
     * @test
     * @testdox Test dat een aangemelde gebruiker een specifieke stads kan zien.
     */
    public function specifiekeStadWeergaveSuccess(): void
    {
        $user = factory(User::class)->create();
        $city = factory(City::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.stadsmonitor.show', $city))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test dat de error response indien met een gemeente met verkeerde id wilt veranderen.
     */
    public function kernVrijWrongId(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get('admin.stadsmonitor.status', ['city' => 10000, 'status' => 0])
            ->assertStatus(404);
    }

    /**
     * @test
     * @testdox Test of men de status van een stad kan veranderen waaneer men niet aangemeld is.
     */
    public function kernVrijNoAUth(): void
    {
        $city = factory(City::class)->create(['kernwapen_vrij' => 0]);

        $this->get(route('admin.stadsmonitor.status', ['city' => $city->id, 'status' => 1]))
            ->assertStatus(302)
            ->assertredirect(route('login'));
    }

    /**
     * @test
     * @testdox Test dat men een stad kernvrij kan maken.
     */
    public function kernVrijSuccess(): void
    {
        $user = factory(User::class)->create();
        $city = factory(City::class)->create(['kernwapen_vrij' => 0]);

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.stadsmonitor.status', ['city' => $city->id, 'status' => 1]))
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => "{$city->name} heeft zich kernwapen vrij verklaard.",
                $this->flashSession . '.level'   => 'info'
            ]);

        $this->assertDatabaseHas('cities', ['id' => $city->id, 'kernwapen_vrij' => 1]);
        $this->assertDatabaseMissing('cities', ['id' => $city->id, 'kernwapen_vrij' => '0']);
    }

    /**
     * @test
     * @testdox Test dat men een gemeente niet kern vrij kan laten verklaren.
     */
    public function nietKernVrijSuccess(): void
    {
        $user = factory(User::class)->create();
        $city = factory(City::class)->create(['kernwapen_vrij' => 1]);

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('admin.stadsmonitor.status', ['city' => $city->id, 'status' => 0]))
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => "{$city->name} heeft zich niet kernwapen vrij verklaard.",
                $this->flashSession . '.level'   => 'info'
            ]);

        $this->assertDatabaseHas('cities', ['id' => $city->id, 'kernwapen_vrij' => 0]);
        $this->assertDatabaseMissing('cities', ['id' => $city->id, 'kernwapen_vrij' => '1']);
    }
}
