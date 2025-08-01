<?php

namespace App\Listeners;

use App\Events\Service\Keypad\KeypadEvent;
use App\Notifications\KeypadNotification;
use Illuminate\Support\Facades\Notification;

class SendKeypadNotification
{
    /**
     * Handle the event.
     *
     * @param  KeypadEvent  $event
     * @return void
     */
    public function handle(KeypadEvent $event)
    {
        $hall = $event->hall;
        $meeting = $hall->meeting;
        
        // Interest oluştur
        $interests = ['meeting-' . $meeting->id . '-announcement'];
        
        // Bildirim verisi
        $notificationData = [
            'interests' => $interests,
            'title' => 'Yeni Oylama',
            'body' => $hall->title . ' salonunda oylama başladı!',
            'hall_id' => $hall->id
        ];
        
        // Tüm katılımcılara bildirim gönder
        $participants = $meeting->participants;
        
        if ($participants->isNotEmpty()) {
            Notification::send($participants, new KeypadNotification($notificationData));
        }
    }
} 