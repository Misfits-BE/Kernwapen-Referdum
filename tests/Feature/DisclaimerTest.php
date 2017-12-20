<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DisclaimerTest extends TestCase
{
    use DatabaseTransactions, DatabaseTransactions; 
    
    /**
     * @test
     * @testdox Disclaimer page kan successvol renderen.
     */
    public function disclaimerPage()
    {
        $this->get(route('disclaimer.index'))->assertStatus(200);
    }
}
