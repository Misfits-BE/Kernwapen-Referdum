<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class DisclaimerTest
 * ----
 * Tests for the policy pages
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature
 */
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
