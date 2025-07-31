<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class KeypadNotification extends Notification
{
    private $keypad;

    public function __construct($keypad)
    {
        $this->keypad = $keypad;
    }

    public function via($notifiable)
    {
        return ['pusher_beams'];
    }

    public function toPushNotification($notifiable)
    {
        return [
            'interests' => $this->keypad['interests'] ?? [],
            'title' => $this->keypad['title'],
            'body' => $this->keypad['body'],
            'data' => [
                'type' => 'keypad',
                'hall_id' => $this->keypad['hall_id'] ?? null
            ]
        ];
    }
}
