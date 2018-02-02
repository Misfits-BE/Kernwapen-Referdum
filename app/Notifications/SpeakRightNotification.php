<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SpeakRightNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Database instance from the city. 
     * 
     * @var \App\City $city
     */
    public $city;

    /**
     * Create a new notification instance.
     *
     * @param  \App\City $city De instantie variable voor de stad. 
     * @return void
     */
    public function __construct($city)
    {
        $this->city = $city;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @todo Fill in the notification
     * 
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        return [
            'message' => 'De gemeente ' . $this->city->name . ' heeft genoeg handtekeningen verzameld.', 
            'url'     => route('admin.stadsmonitor.show', ['city' => $this->city->id])            
        ];
    }
}
