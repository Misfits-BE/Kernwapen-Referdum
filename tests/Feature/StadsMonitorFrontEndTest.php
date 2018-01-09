<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StadsMonitorFrontEndTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een gast bebruiker de pagina van de monitor kan bekijken zonder problemen.
     */
    public function indexPagina()
    {
        $this->get(route('stadsmonitor.index'))->assertStatus(200);
    }
}
