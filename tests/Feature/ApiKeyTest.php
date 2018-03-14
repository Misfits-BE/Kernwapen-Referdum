<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiKeyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox API token probeer te hergenereren wanneer niet aangemeld
     */
    public function apiTokenHergenereerNietAangemeld(): void
    {

    }

    /**
     * @test
     * @testdox API Token hergenereer token met foutieve identifier
     */
    public function apiTokenHergenereerFoutieveId(): void
    {

    }

    /**
     * @test
     * @testdox API Token hergenereer success
     */
    public function apiTokenHergenereerSuccess(): void
    {

    }

    /**
     * @test
     * @testdox API Token hergenereer geblokkeerde gebruiker
     */
    public function apiTokenHergenereerBannedUser(): void
    {

    }

    /**
     * @test 
     * @testdox Probeer een api token aan te maken wanneer de gebruiken niet is ingelogd.
     */
    public function apiTokenAanmakenNietAangemeld(): void
    {

    }

    /**
     * @test 
     * @testdox
     */
    public function apiTokenAanmakenValidatieFouten(): void
    {

    }

    public function apiTokenAanmakenSucces(): void
    {

    }

    public function apiTokenAanmakenGeblokkeerdeGebruiker(): void
    {

    }

    public function apiTokenVerwijderGeblokkeerdeGebruiker(): void
    {

    }

    public function apiTokenVerwijderOngeldigeId(): void
    {

    }

    public function apiTokenVerwijderSuccess(): void
    {

    }

    public function apiTokenVerwijderNietAangemeld(): void
    {

    }
}
