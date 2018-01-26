<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DisclaimerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     * @testdox Disclaimer page kan successvol renderen.
     */
    public function disclaimerPage(): void
    {
        $this->get(route('disclaimer.index'))->assertStatus(200);
    }
}
