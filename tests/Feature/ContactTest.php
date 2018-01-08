<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Test of een gebruiker zonder problemen de contact pagina kan bereiken.
     */
    public function contactIndex(): void
    {
        $this->get(route('contact.index'))->assertStatus(200);
    }
}
