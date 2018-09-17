<?php

namespace Tests\Feature\News\Frontend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class IndexTest 
 * ----
 * PHPUnit testcase voor de frontend index pagine van de nieuwsartikelen
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature\News\Backend
 */
class IndexTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * @test 
     * @testdox Test of een gast gebruiker de nieuwsberichten kan zien zonder problemen
     * 
     * @group news
     */
    public function indexPage(): void 
    {
        $this->get(route('news.index'))->assertStatus(200);
    }
}
