<?php

namespace App\Console\Commands;

use App\Service\Announcement\Beams;
use Illuminate\Console\Command;

class TestPusherBeams extends Command
{
    protected $signature = 'pusher:test';
    protected $description = 'Test Pusher Beams connection and send a test notification';

    public function handle(): void
    {
        $this->info('Testing Pusher Beams connection...');
        
        // Pusher Beams config'leri kontrol et
        $instanceId = config('services.pusher.beams_instance_id');
        $secretKey = config('services.pusher.beams_secret_key');
        
        if (!$instanceId || !$secretKey) {
            $this->error('Pusher Beams credentials are not configured!');
            $this->error('Please check your .env file for:');
            $this->error('- PUSHER_BEAMS_INSTANCE_ID');
            $this->error('- PUSHER_BEAMS_SECRET_KEY');
            return;
        }
        
        $this->info('Instance ID: ' . substr($instanceId, 0, 10) . '...');
        $this->info('Secret Key: ' . substr($secretKey, 0, 10) . '...');
        
        try {
            $beams = new Beams();
            
            // Test notification gönder
            $interests = ['test-notification'];
            $title = 'Test Notification';
            $body = 'This is a test notification from KongrePad';
            
            $this->info("\nSending test notification...");
            $this->info("Interests: " . implode(', ', $interests));
            $this->info("Title: $title");
            $this->info("Body: $body");
            
            $result = $beams->sendNotification($interests, $title, $body);
            
            if ($result['success']) {
                $this->info("\n✅ Notification sent successfully!");
                $this->info("Response: " . json_encode($result['response'], JSON_PRETTY_PRINT));
            } else {
                $this->error("\n❌ Failed to send notification!");
                $this->error("Error: " . $result['error']);
            }
            
        } catch (\Exception $e) {
            $this->error("\n❌ Exception occurred!");
            $this->error("Error: " . $e->getMessage());
            $this->error("Trace: " . $e->getTraceAsString());
        }
    }
} 