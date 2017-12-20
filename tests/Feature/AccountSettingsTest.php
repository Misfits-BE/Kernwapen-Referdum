<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountSettingsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions; 

    /**
     * @test 
     * @testdox Test als een niet ngelogde gesbruiker de account instellingen kan benaderen. 
     */
    public function testAccountInstellingenNietAangemeld() 
    {
        $this->get(route('account.settings', ['type' => 'informatie']))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test 
     * @testdox Test dat een aangemelde gebruiker geen errors krijgt op de account instellingen pagina.
     */
    public function testAccountInstellingenAangemeld() 
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('account.settings', ['type' => 'informatie']))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test dat een niet aangemelde gebruiker geen account info kan aanpassen.
     */
    public function updateInfoGeenAuthencatie() 
    {
        $user  = factory(User::class)->create(); 
        $input = ['name' => 'test gebruiker', 'email' => 'test@doemin.tld']; 

        $this->patch(route('account.settings.info'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test als een aangemelde gebruiker zijn informatie niet kan aanpassen met validatie fouten.
     */
    public function updateInfoAuthencatieValidatieFouten() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->patch(route('account.settings.info'), [])
            ->assertSessionHasErrors()
            ->assertSessionMissing([
                $this->flashSession . '.message' => trans('user.flash-update-information'),
                $this->flashSession . '.level'   => 'success'
            ]);

        $this->assertDatabaseHas('users', ['name' => $user->name, 'email' => $user->email]);
    }

    /**
     * @test
     * @testdox Test dat een aangemelde gebruiker zijn account informatie kan aanpassen.
     */
    public function updateInfoAuthencatieMetSuccess() 
    {
        $user  = factory(User::class)->create(); 
        $input = ['name' => 'test gebruiker', 'email' => 'test@domain.tld'];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->patch(route('account.settings.info'), $input)
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => trans('user.flash-update-information'),
                $this->flashSession . '.level'   => 'success'
            ]);

        $this->assertDatabaseMissing('users', ['name' => $user->name, 'email' => $user->email]); 
        $this->assertDatabaseHas('users', $input);
    }

    /**
     * @test
     * @testdox Test dat een niet aangemelde een login zijn beveiliging niet kan aanpassen.
     */
    public function updateBeveiligingGeenAuthencatie() 
    {
        $input = ['password' => '123456789!', 'password_confirmation' => '123456789!'];

        $this->patch(route('account.settings.security'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function updateBeveilingValidatieFouten() 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->patch(route('account.settings.security'), [])
            ->assertSessionHasErrors()
            ->assertSessionMissing([
                $this->flashSession . '.message' => trans('user.flash-update-security'),
                $this->flashSession . '.level'   => 'success'
            ]);

        $this->assertDatabaseHas('users', ['name' => $user->name, 'email' => $user->email]);
    }

    /**
     * @test
     */
    public function updateBeveiligingMetSuccess() 
    {
        $user  = factory(User::class)->create(); 
        $input = ['password' => '123456789!', 'password_confirmation' => '123456789!'];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->patch(route('account.settings.security'), $input)
            ->assertStatus(302)
            ->assertSessionHas([
                $this->flashSession . '.message' => trans('user.flash-update-security'),
                $this->flashSession . '.level'   => 'success'
            ]);
    }
}
