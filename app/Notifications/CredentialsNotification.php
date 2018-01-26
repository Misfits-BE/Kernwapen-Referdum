<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Notificatie voor het gegenereerde wachtwoord bij de gebruiker in kwestie te krijgen
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App\Notifications
 */
class CredentialsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Het gegenereerde wachtwoord voor de gebruiker. 
     * 
     * @var string
     */
    public $user; 

    /**
     * De databank entiteit van de aangemaakte gebruiker. 
     * 
     * @return \App\User
     */
    public $password;

    /**
     * Create a new notification instance.
     *
     * @param  \App\User $user      De databank entiteit van de aangemaakte gebruiker
     * @param  string    $password  Het gegenereerde wachtwoord voor de gebruiker
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Er is een login op activisme.be voor u aangemaakt.')
            ->greeting('Geachte,')
            ->line('Een adminstrator heeft voor jouw een login aangemaakt op '  . config('app.name'))
            ->line("U kunt zich aanmelden met uw email adres en het volgende wachtwoord: `{$this->password}`.")
            ->action('Aanmelden', route('login'));
    }
}
