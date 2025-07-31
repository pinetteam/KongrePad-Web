<?php

namespace App\Broadcasting;

use App\Service\Announcement\Beams;

class PusherBeamsChannel
{
    protected Beams $beams;

    public function __construct()
    {
        $this->beams = new Beams();
    }

    public function send($notifiable, $notification)
    {
        if (method_exists($notification, 'toPushNotification')) {
            $data = $notification->toPushNotification($notifiable);
            $interests = $data['interests'] ?? [$notifiable->routeNotificationFor('pusher_beams')];
            $title = $data['title'] ?? 'Bildirim';
            $body = $data['body'] ?? '';
            $extraData = $data['data'] ?? [];
            
            // Notification tipine göre uygun metodu çağır
            if (isset($extraData['type'])) {
                switch ($extraData['type']) {
                    case 'keypad':
                        return $this->beams->sendKeypadNotification(
                            $interests, 
                            $title, 
                            $body, 
                            $extraData['hall_id'] ?? ''
                        );
                    case 'debate':
                        return $this->beams->sendDebateNotification(
                            $interests, 
                            $title, 
                            $body, 
                            $extraData['hall_id'] ?? ''
                        );
                    default:
                        return $this->beams->sendNotification($interests, $title, $body, $extraData);
                }
            }
            
            return $this->beams->sendNotification($interests, $title, $body, $extraData);
        }
        throw new \Exception('Notification does not implement toPushNotification method.');
    }
}
