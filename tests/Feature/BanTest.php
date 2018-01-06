<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BanTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox Test de response wanneer we gebruiker die al geband is proberen te bannen. 
     */
    public function banAlreadyBanned() 
    {

    }

    /**
     * @test 
     * @testdox Test of we zonder fouten een gebruiker kunnen blokkeren. 
     */
    public function banSuccess() 
    {

    }

    /**
     * @test 
     * @testdox Test de error respons wanneer een gebruiker met niet bestaande id bannen. 
     */
    public function banWrongId() 
    {

    }

    /**
     * @test 
     * @testdox Test o)f een niet aangemelde gebruiker een andere gebruiker kan blokkeren
     */
    public function banNoAuth() 
    {

    }

    /**
     * @test 
     * @test Test de response wanneer we een gebruiker die al actief is nog is proberen te activeren.
     */
    public function unbanAlreadyUnbanned() 
    {

    }

    /**
     * @test 
     * @testdox Test de response wanneer we succesvol een gebruiker hebben geactiveerd. 
     */
    public function unbanSuccess() 
    {

    }

    /**
     * @test 
     * @testdox Test de response wanneer een gebruiker met verkeerde id proberen te activeren. 
     */
    public function unbanWrongId() 
    {

    }

    /**
     * @test 
     * @testdox Test of een niet aangemelde gebruiker een andere gebruiker kan activeren.
     */
    public function unbanNoAuth() 
    {

    }
}
