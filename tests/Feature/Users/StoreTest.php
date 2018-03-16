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
     * @testdox
     */
    public function nietAangemeld(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function success(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validatieRequiredNaam(): void
    {

    }

    public function validatieMaxNaam(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validationStringNaam(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validatieRequiredRol(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validatieStringRol(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validatieMaxRol(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validatieEmailRequired(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validatieEmailUnique(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validatieEmailString(): void
    {

    }

    /**
     * @test
     * @testdox
     */
    public function validatieEmailMax()
    {

    }
}
