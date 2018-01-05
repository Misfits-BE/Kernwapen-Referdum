<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;
    
    /**
     * @test
     * @testdox Test of de frontend index pagina succesvol kan renderen.
     */
    public function frontendIndex()
    {
        $this->get(route('frontend.index'))->assertStatus(200);
    }
}
