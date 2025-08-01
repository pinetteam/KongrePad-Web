<?php

namespace App\Listeners;

use App\Events\Service\Debate\DebateEvent;
use App\Notifications\DebateNotification;
use Illuminate\Support\Facades\Notification;

class SendDebateNotification
{
    /**
     * Handle the event.
     *
     * @param  DebateEvent  $event
     * @return void
     */
    public function handle(DebateEvent $event)
    {
        $hall = $event->hall;
        $meeting = $hall->meeting;
        
        // Interest oluştur
        $interests = ['meeting-' . $meeting->id . '-announcement'];
        
        // Bildirim verisi
        $notificationData = [
            'interests' => $interests,
            'title' => 'Tartışma Başladı',
            'body' => $hall->title . ' salonunda tartışma başladı!',
            'hall_id' => $hall->id
        ];
        
        // Tüm katılımcılara bildirim gönder
        $participants = $meeting->participants;
        
        if ($participants->isNotEmpty()) {
            Notification::send($participants, new DebateNotification($notificationData));
        }
    }
} 