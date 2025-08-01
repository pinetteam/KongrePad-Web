<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class AnnouncementNotification extends Notification
{
    private $announcement;

    public function __construct($announcement)
    {
        $this->announcement = $announcement;
    }

    public function via($notifiable)
    {
        return ['pusher_beams'];
    }

    public function toPushNotification($notifiable)
    {
        return [
            'interests' => $this->announcement['interests'] ?? [],
            'title' => $this->announcement['title'],
            'body' => $this->announcement['body'],
        ];
    }
}
