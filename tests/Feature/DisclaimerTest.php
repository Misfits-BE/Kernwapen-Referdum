<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DisclaimerTest extends TestCase
{
    /**
     * @test
     * @testdox Disclaimer page kan successvol renderen.
     */
    public function disclaimerPage()
    {
        $this->get(route('disclaimer.index'))->assertStatus(200);
    }
}
