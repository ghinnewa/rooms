<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CardApprovalNotification extends Notification
{
    public $card;
    public $status;
    public $comment;

    public function __construct($card, $status, $comment = null)
    {
        $this->card = $card;
        $this->status = $status;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        \Log::info('Notification sent for card ID: ' . $this->card->id);
    
        return [
            'card_id' => $this->card->id,
            'message' => $this->status === 'approved' 
                        ? 'Your card has been approved.' 
                        : 'Your card has been rejected.' . $this->comment,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'card_id' => $this->card->id,
            'message' => $this->status === 'approved' 
                        ? 'Your card has been approved.' 
                        : 'Your card has been rejected :' . $this->comment,
        ]);
    }
}