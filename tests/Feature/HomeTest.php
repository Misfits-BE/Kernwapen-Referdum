<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    /**
     * @test
     * @testdox Test of de frontend index pagina succesvol kan renderen.
     */
    public function frontendIndex()
    {
        $this->get(route('frontend.index'))->assertStatus(200);
    }
}
