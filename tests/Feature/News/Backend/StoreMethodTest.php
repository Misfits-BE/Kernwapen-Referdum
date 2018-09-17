<?php

namespace Tests\Feature\News\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

/**
 * Class StoreMethodTest 
 * ---- 
 * PHPUnit testcase voor de opslag van een nieuwsbericht. 
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\News\Backend
 */
class StoreMethodTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /**
     * @test
     * @testdox Test of een aangemelde gebruiker zonder problemen een nieuwsbericht kan aanmaken. 
     */
    public function successAuthenticated(): void 
    { 
        $fake   = $this->faker($this->locale);
        $user   = factory(User::class)->create(); 
        $input  = ['titel' => $fake->word, 'bericht' => $fake->paragraph, 'is_public' => $fake->boolean];

        $this->actingAs($user)
            ->post(route('admin.news.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('admin.news.index'))
            ->assertSessionHas([
                $this->flashSession . '.message'   => $input['titel'] . ' is aangemaakt als nieuwsbericht in het systeem.', 
                $this->flashSession . '.level'     => 'success', 
                $this->flashSession . '.important' => false
            ]);

        $this->assertDatabaseHas('articles', array_merge($input, ['author_id' => $user->id]));
    }

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker geen nieuwsbericht kan aanmaken. 
     */
    public function unauthenticated(): void
    {
        $fake   = $this->faker($this->locale);
        $input  = ['titel' => $fake->word, 'bericht' => $fake->paragraph, 'is_public' => $fake->boolean];

        $this->post(route('admin.news.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox test de validatie regel dat een status vereist is. 
     */
    public function validationIsPublicRequired(): void 
    {
        $fake  = $this->faker($this->locale);
        $user  = factory(User::class)->create();
        $input = ['titel' => $fake->word, 'bericht' => $fake->paragraph]; 

        $this->actingAs($user)
            ->post(route('admin.news.store'), $input)
            ->assertSessionHasErrors(['is_public' => 'U moet een status opgeven voor het nieuwsbericht.']);
    } 

    /**
     * @test 
     * @testdox Validatie regel om te zeggen dat het status veld alleen een boolean waarde mag bevatten. 
     */
    public function validationIsPublicBoolean(): void 
    {
        $fake  = $this->faker($this->locale);
        $user  = factory(User::class)->create();
        $input = ['titel' => $fake->word, 'bericht' => $fake->paragraph, 'is_public' => $fake->word]; 

        $this->actingAs($user)
            ->post(route('admin.news.store'), $input)
            ->assertSessionhasErrors(['is_public' => 'Kan alleen de waarde klad of publicatie bevatten.']);
    }

    /**
     * @test 
     * @testdox Validatie regel om te checken of de content van een nieuwsbericht vereist is. 
     */
    public function validationBerichtRequired(): void 
    {
        $fake  = $this->faker($this->locale); 
        $user  = factory(User::class)->create(); 
        $input = ['titel' => $fake->word, 'is_public' => $fake->boolean];

        $this->actingAs($user)
            ->post(route('admin.news.store'), $input)
            ->assertSessionHasErrors(['bericht' => trans('validation.required', ['attribute' => 'bericht'])]);
    }

    /**
     * @test 
     * @testdox Validatie regel test om te checken of de content van een nieuwsbericht alleen een tekenreeks kan zijn.
     */
    public function validationBerichtString(): void 
    {
        $fake  = $this->faker($this->locale);
        $user  = factory(User::class)->create();
        $input = ['bericht' => $fake->numberBetween(0, 10000), 'is_public' => $fake->boolean, 'titel' => $fake->word]; 

        $this->actingAs($user)
            ->post(route('admin.news.store'), $input)
            ->assertSessionhasErrors(['bericht' => trans('validation.string', ['attribute' => 'bericht'])]);
    }

    /**
     * @test
     * @testdox validatie regel test om te checken of een titel van een nieuwsbericht vereist is. 
     */
    public function validationTitelRequired(): void 
    {
        $fake  = $this->faker($this->locale);
        $user  = factory(User::class)->create();
        $input = ['is_public' => $fake->boolean, 'bericht' => $fake->paragraph];

        $this->actingAs($user)
            ->post(route('admin.news.store'), $input)
            ->assertSessionHasErrors(['titel' => trans('validation.required', ['attribute' => 'titel'])]);
    }

    /**
     * @test
     * @testdox Validatie regel test om te checken of een titel maar max 190 karakters mag bevatten.
     */
    public function validationTitelMax190(): void 
    {
        $fake  = $this->faker($this->locale); 
        $user  = factory(User::class)->create();
        $input = ['is_public' => $fake->boolean, 'bericht' => $fake->paragraph, 'titel' => str_random(275)];

        $this->actingAs($user)
            ->post(route('admin.news.store'), $input)
            ->assertSessionhasErrors(['titel' => trans('validation.max.string', [
                'max' => 190, 'attribute' => 'titel'
            ])]);
    }
    
    /**
     * @test 
     * @testdox Validatie regel om te checken of de titel van een nieuwsbericht alleen maar een tekenreeks mag zijn. 
     */
    public function validationTitelString(): void 
    {
        $fake  = $this->faker($this->locale);
        $user  = factory(User::class)->create();
        $input = ['is_public' => $fake->boolean, 'bericht' => $fake->paragraph, 'titel' => $fake->numberBetween(0, 250)];

        $this->actingAs($user)
            ->post(route('admin.news.store'), $input)
            ->assertSessionHasErrors(['titel' => trans('validation.string', ['attribute' => 'titel'])]);
    }
}
