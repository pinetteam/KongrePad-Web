<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class DebateNotification extends Notification
{
    private $debate;

    public function __construct($debate)
    {
        $this->debate = $debate;
    }

    public function via($notifiable)
    {
        return ['pusher_beams'];
    }

    public function toPushNotification($notifiable)
    {
        return [
            'interests' => $this->debate['interests'] ?? [],
            'title' => $this->debate['title'],
            'body' => $this->debate['body'],
            'data' => [
                'type' => 'debate',
                'hall_id' => $this->debate['hall_id'] ?? null
            ]
        ];
    }
}
