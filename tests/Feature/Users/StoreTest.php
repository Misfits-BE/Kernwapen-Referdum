<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    }

    /**
     * @test
     * @testdox Test if de geauthenceerde gebruiker een gebruiker kan aanmaken.
     */
    public function success(): void
    {

    }

    /**
     * @test
     * @testdox Test of de naam in het formulier vereist is.
     */
    public function validatieRequiredNaam(): void
    {

    }

    /**
     * @test
     * @testdox Test de maximum lengte van de naam die de gebruiker kan opgeven.
     */
    public function validatieMaxNaam(): void
    {

    }

    /**
     * @test
     * @testdox Test dof de waarde van het naam veld een string moet zijn. 
     */
    public function validationStringNaam(): void
    {

    }

    /**
     * @test
     * @testdox Test of de waarde van het veld gebruikers rol vereist is. 
     */
    public function validatieRequiredRol(): void
    {

    }

    /**
     * @test
     * @testdox Test of de waarde in de gebruikers permissie dropdown een string is. 
     */
    public function validatieStringRol(): void
    {

    }

    /**
     * @test
     * @testdox Test validatie voor de maximum lengte van de gebruikersrol. 
     */
    public function validatieMaxRol(): void
    {

    }

    /**
     * @test
     * @testdox Test dat het email veld vereist is. 
     */
    public function validatieEmailRequired(): void
    {

    }

    /**
     * @test
     * @testdox Test of de waarde in het email veld een unieke waarde is in de databank.
     */
    public function validatieEmailUnique(): void
    {

    }

    /**
     * @test
     * @testdox Validatie check dat een email adres wel effectief een email adres is.
     */
    public function validatieEmailString(): void
    {

    }

    /**
     * @test
     * @testdox Test de maximum lengte voor het email formulier veld.
     */
    public function validatieEmailMax()
    {

    }
}
