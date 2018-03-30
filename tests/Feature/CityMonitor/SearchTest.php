<?php

namespace Tests\Feature\CityMonitor;

use Tests\TestCase;
use App\{City, User};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class SearchTest
 * ----
 * PHPUnit testcase voor het testen van de zoekfunctie in de satdsmonitor
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\CityMonitor
 */
class SearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een niet aangemelde gebruiker geen zoekopdracht kan uitvoern in de backend. 
     */
    public function backendNietAangemeld(): void
    {
        $city = factory(City::class)->create();

        $this->get(route('admin.stadsmonitor.search', ['term' => $city->name]))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @testdox Test of een zoekopdracht kan worden uitgevoerd zonder problemen in de front-end
     */
    public function successFrontend(): void 
    {
        $cities = factory(City::class, 20)->create(); 

        $this->get(route('stadsmonitor.search', ['term' => $cities[0]->name]))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of een zoekopdrcht zonder fouten kan uitgevoerd worden in de back-end
     */
    public function successBackend(): void 
    {
        $user = factory(User::class)->create();
        $cities = factory(City::class, 20)->create();

        $this->actingAs($user)
            ->get(route('admin.stadsmonitor.search', ['term' => $cities[0]->name]))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test of een invoer veriest is bij de back-end zoek functie
     */
    public function backendValidatieVereist(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('admin.stadsmonitor.search'))
            ->assertSessionhasErrors(['term' => trans('validation.required', ['attribute' => 'term'])]);
    }

    /**
     * @test
     * @testdox Test of een invoer vereist is bij de front-end zoek functie
     */
    public function frontendValidatieVereist(): void 
    {
        $this->get(route('stadsmonitor.search'))
            ->assertSessionHasErrors(['term' => trans('validation.required', ['attribute' => 'term'])]);
    }
}
