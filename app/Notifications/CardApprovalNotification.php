<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Http\Request;

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
        \Log::info('Notification triggered for card status change: ' . $this->status);
        return ['database', 'broadcast'];
    }
    

   // App\Notifications\CardApprovalNotification.php
public function toDatabase($notifiable)
{
    return [
        'card_id' => $this->card->id,
        'message' => $this->status === 'approved' ? 'Your card has been approved.' : 'Your card has been rejected.',
        'comment' => $this->comment, // Include the comment if the card is rejected
        'type' => 'App\\Notifications\\CardApprovalNotification', // Type identifier
    ];
}

public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        'card_id' => $this->card->id,
        'message' => $this->status === 'approved' ? 'Your card has been approved.' : 'Your card has been rejected.',
        'comment' => $this->comment,
        'type' => 'App\\Notifications\\CardApprovalNotification',
    ]);
}

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead(); // This method will update the `read_at` timestamp
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }

    
}