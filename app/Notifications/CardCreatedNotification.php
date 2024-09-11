<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CardCreatedNotification extends Notification
{
    public $card;

    public function __construct($card)
    {
        $this->card = $card;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'card_id' => $this->card->id,
            'message' => 'A new card has been created by ' . $this->card->user->name,
        ]);
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'card_id' => $this->card->id,
            'message' => 'A new card has been created by ' . $this->card->user->name,
        ]);
    }
}