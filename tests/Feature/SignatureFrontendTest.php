<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class SignatureFrontendTest 
 * ---- 
 * Test the signature methods for the frontend in the application. 
 * 
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature
 */
class SignatureFrontendTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     * @testdox Test of een gast zonder fouten kan intekenen op de petitie.
     */
    public function handtekeningOpslagSuccess(): void
    {
        $input = [
            'voornaam' => 'John', 'achternaam' => 'Doe', 'geboortedatum'    => '1995-10-10',
            'postcode' => '0000', 'straatnaam' => 'Hacker Way', 'stadsnaam' => 'Nashville',
            'huis_nr'  => 1
        ];

        $this->post(route('signature.store'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('frontend.index'))
            ->assertSessionHas([
                $this->flashSession . '.message' => trans('signature.flash-thank-you', [
                    'firstname' => $input['voornaam'], 'lastname' => $input['achternaam']
                ]),
                $this->flashSession . '.level' => 'success',
            ]);

        // array_except() omdat de data word omgevorm in de database.
        // Wegens timestamp entiteit op de database kolom.
        $this->assertDatabaseHas('signatures', array_except($input, ['geboortedatum']));
    }

    /**
     * @test
     * @testdox Test of de validatie errors worden gezet in de return bij foutieve invulling v/h formulier.
     */
    public function handTekeningOpslagValidatieFouten(): void
    {
        $input = ['voornaam' => 'John', 'achternaam' => 'Doe'];

        $this->post(route('signature.store'), [])
            ->assertStatus(302)
            ->assertRedirect(route('frontend.index'))
            ->assertSessionMissing([
                $this->flashSession . '.message' => trans('signature.flash-thank-you', [
                    'firstname' => $input['voornaam'], 'lastname' => $input['achternaam']
                ]),
                $this->flashSession . '.level' => 'success',
            ]);
    }
}
