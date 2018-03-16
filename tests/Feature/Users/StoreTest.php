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

    public function nietAangemeld(): void
    {

    }

    public function success(): void
    {

    }

    public function validatieRequiredNaam(): void
    {

    }

    public function validatieMaxNaam(): void
    {

    }

    public function validationStringNaam(): void
    {

    }

    public function validatieRequiredRol(): void
    {

    }

    public function validatieStringRol(): void
    {

    }

    public function validatieMaxRol(): void
    {

    }

    public function validatieEmailRequired(): void
    {

    }

    public function validatieEmailUnique(): void
    {

    }

    public function validatieEmailString(): void
    {

    }

    public function validatieEmailMax()
    {

    }
}
