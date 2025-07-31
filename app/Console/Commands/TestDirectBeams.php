<?php

namespace App\Console\Commands;

use App\Service\Announcement\Beams;
use App\Models\Meeting\Meeting;
use Illuminate\Console\Command;

class TestDirectBeams extends Command
{
    protected $signature = 'beams:test-direct {meeting_id?} {--type=announcement : Notification type (announcement, keypad, debate)}';
    protected $description = 'Test direct Pusher Beams notification sending';

    public function handle(): void
    {
        $this->info('Testing direct Pusher Beams notification...');
        
        // Meeting ID al
        $meetingId = $this->argument('meeting_id') ?? 2; // default olarak 2
        $meeting = Meeting::find($meetingId);
        
        if (!$meeting) {
            $this->error("Meeting with ID $meetingId not found!");
            return;
        }
        
        $this->info("Using meeting: {$meeting->title} (ID: {$meeting->id})");
        
        $type = $this->option('type');
        
        try {
            $beams = new Beams();
            
            // Interest oluştur
            $interests = ['meeting-' . $meeting->id . '-announcement'];
            
            switch ($type) {
                case 'keypad':
                    $title = 'Yeni Oylama';
                    $body = 'Salon A\'da oylama başladı';
                    $this->info("\nSending KEYPAD notification...");
                    $result = $beams->sendKeypadNotification($interests, $title, $body, '456');
                    break;
                    
                case 'debate':
                    $title = 'Tartışma Başladı';
                    $body = 'Salon B\'de tartışmaya katılın';
                    $this->info("\nSending DEBATE notification...");
                    $result = $beams->sendDebateNotification($interests, $title, $body, '789');
                    break;
                    
                default:
                    $title = 'Test Duyuru - ' . date('H:i:s');
                    $body = 'Bu bir test duyurusudur. Meeting: ' . $meeting->title;
                    $this->info("\nSending ANNOUNCEMENT notification...");
                    $result = $beams->sendNotification($interests, $title, $body);
                    break;
            }
            
            $this->info("Interests: " . implode(', ', $interests));
            $this->info("Title: $title");
            $this->info("Body: $body");
            $this->info("Type: $type");
            
            // Participant sayılarını göster
            $this->info("\nParticipant counts for this meeting:");
            $this->info('Agents: ' . $meeting->participants()->where('type', 'agent')->count());
            $this->info('Attendees: ' . $meeting->participants()->where('type', 'attendee')->count());
            $this->info('Teams: ' . $meeting->participants()->where('type', 'team')->count());
            $this->info('Total: ' . $meeting->participants()->count());
            
            if ($result['success']) {
                $this->info("\n✅ Notification sent successfully!");
                $this->info("Response: " . json_encode($result['response'], JSON_PRETTY_PRINT));
                
                $this->info("\n📱 To receive this notification, your Flutter app must:");
                $this->info("1. Be subscribed to interest: " . $interests[0]);
                $this->info("2. Have push notifications enabled");
                $this->info("3. Have a valid FCM/APNs token");
                
                $this->info("\n🔔 Flutter Format Check:");
                $this->info("✓ Web notification with icon");
                $this->info("✓ APNs with alert format");
                $this->info("✓ FCM with notification and data");
                $this->info("✓ Type: $type");
                
            } else {
                $this->error("\n❌ Failed to send notification!");
                $this->error("Error: " . $result['error']);
            }
            
        } catch (\Exception $e) {
            $this->error("\n❌ Exception occurred!");
            $this->error("Error: " . $e->getMessage());
        }
    }
} 