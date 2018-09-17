<?php

namespace Tests\Feature\Activity;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class SearchTest 
 * ----
 * PHPUnit testsuite voor de zoek methode van de activiteiten log. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\Activity
 */
class SearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test 
     * @testdox Test de HTTP code en doorverwijzing wanneer er geen gebruiker is aangemeld.
     */
    public function nietAangemeld(): void 
    {
        $this->get(route('admin.logs.search', ['term' => 'search-term']))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test of een administrator de zoek methode kan gebruiken zonder problemen. 
     */
    public function success(): void 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->get(route('admin.logs.search', ['term' => 'search-term']))
            ->assertStatus(200);
    }

    /**
     * @test 
     * @testdox Test of de term vereist is voor de search 
     */
    public function validatieRequired(): void 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->get(route('admin.logs.search'))
            ->assertSessionHasErrors(['term' => trans('validation.required', ['attribute' => 'term'])]);
    }

    /**
     * @test 
     * @testdox sTest of de gegeven invoer niet langer mag zijn dat 120 karakters
     */
    public function validateMax120(): void 
    {
        $user = factory(User::class)->create(); 

        $this->actingAs($user)
            ->get(route('admin.logs.search', ['term' => str_random(257)]))
            ->assertSessionHasErrors([
                'term' => trans('validation.max.string', ['attribute' => 'term', 'max' => 120])
            ]);
    }
}
