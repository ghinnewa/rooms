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

    // App\Notifications\CardCreatedNotification.php
// App\Notifications\CardCreatedNotification.php
public function toDatabase($notifiable)
{
    return [
        'card_id' => $this->card->id,
        'message' => 'A new card has been created by ' . $this->card->user->name,
        'url' => route('cards.show', $this->card->id), // Ensure this route exists and points to the correct page
        'type' => 'App\\Notifications\\CardCreatedNotification', // Type identifier
    ];
}

public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        'card_id' => $this->card->id,
        'message' => 'A new card has been created by ' . $this->card->user->name,
        'url' => route('cards.show', $this->card->id), // Ensure this is correct
        'type' => 'App\\Notifications\\CardCreatedNotification',
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