<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class SubscribeMailNotification 
 * ----
 * Mail notificatie voor het zenden van een mail wanneer een gebruiker
 * de petitie ondertekend. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App\Notifications
 */
class SubscribeMailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Database instance from the city.
     *
     * @var Signature $signature The signature entity form the database.
     */
    public $signature;

    /**
     * Create a new notification instance.
     *
     * @param  Signature Register the signature data to a gloal variable.
     * @return void
     */
    public function __construct($signature)
    {
        $this->signature = $signature;
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
            ->subject('U hebt de petitie van ' . config('app.name') . ' ondertekend.')
            ->markdown('email.signatures.signed', ['signature' => $this->signature]);
    }
}
