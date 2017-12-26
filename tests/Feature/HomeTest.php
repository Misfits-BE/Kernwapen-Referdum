<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use DatabaseTransactions, DatabaseTransactions;
    
    /**
     * @test
     * @testdox Test of de frontend index pagina succesvol kan renderen.
     */
    public function frontendIndex()
    {
        $this->get(route('frontend.index'))->assertStatus(200);
    }
}
