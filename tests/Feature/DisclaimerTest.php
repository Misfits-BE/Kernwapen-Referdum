<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

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
