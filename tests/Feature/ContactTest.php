<?php

namespace Tests\Feature;

use App\Mail\contactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Class ContactTest 
 * ---- 
 * Tests for testing the contact system. 
 * 
 * @author      Tim Joosten <topairy@gmail.com>
 * @copyright   2018 Tim Joosten
 * @package     Tests\Feature
 */
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

    /**
     * @test
     * @testdox Test of men de contact email kan versturen zonder problemen.
     */
    public function sendSuccess(): void
    {
        Mail::fake();

        $input = [
            'naam'      => 'John Doe', 'email'   => 'johndoe@domain.org',
            'onderwerp' => 'subject',  'bericht' => 'message'
        ];

        $this->post(route('contact.send'), $input)
            ->assertStatus(302)
            ->assertRedirect(route('contact.index'))
            ->assertSessionHas([
                $this->flashSession . '.message' => 'We hebben je email verzonden, en nemen spoedig contact met je op.',
                $this->flashSession . '.level'   => 'success',
            ]);

        // Assert a message was sent to the given users...
        Mail::assertSent(contactForm::class, function ($mail) use ($input) {
            return $mail->hasTo(config('platform.contact_email'));
        });
    }

    /**
     * @test
     * @testdox Test of er validatiefouten geregistreerd worden bij het foutief invullen v/h formulier.
     */
    public function sendError(): void
    {
        $this->post(route('contact.send'), [])
            ->assertStatus(302)
            ->assertSessionHasErrors()
            ->assertSessionMissing([
                $this->flashSession . '.message' => 'We hebben je email verzonden, en nemen spoedig contact met je op.',
                $this->flashSession . '.level'   => 'success',
            ]);
    }
}
