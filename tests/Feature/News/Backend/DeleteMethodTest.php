<?php

namespace Tests\Feature\News\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class DeletemethodTest 
 * ---- 
 * PHPUnit testcase voor het testen van de method die nieuwsberichten verwijderd. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Test\Feature\News\Backend
 */
class DeleteMethodTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een aangemelde gebruiker succesvol een nieuwsbericht kan verwijderen.
     */
    public function success(): void 
    {
        //
    }

    /**
     * @test
     * @testdox test de error response wanneer de gebruiker niet is aangemeld.
     */
    public function unauthenticated(): void 
    {
        //
    }

    /**
     * @test
     * @testdox Test de error response wanneer we een nieuwsbericht verwijderen met ongeldige id. 
     */
    public function invalidId(): void 
    {
        //
    }
}
