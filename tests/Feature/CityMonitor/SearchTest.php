<?php

namespace Tests\Feature\CityMonitor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class SearchTest
 * ----
 * PHPUnit testcase voor the testen van de zoekfunctie in de satdsmonitor
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

    }

    /**
     * @test
     * @testdox Test of een zoekopdracht kan worden uitgevoerd zonder problemen in de front-end
     */
    public function successFrontend(): void 
    {

    }

    /**
     * @test
     * @testdox Test of een zoekopdrcht zonder fouten kan uitgevoerd worden in de back-end
     */
    public function successBackend(): void 
    {

    }

    /**
     * @test
     * @testdox Test of een invoer veriest is bij de back-end zoek functie
     */
    public function backendValidatieVereist(): void
    {

    }

    /**
     * @test
     * @testdox Test of een invoer vereist is bij de front-end zoek functie
     */
    public function frontendValidatieVereist(): void 
    {

    }
}
