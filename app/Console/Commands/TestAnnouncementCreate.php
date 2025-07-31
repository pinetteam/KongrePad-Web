<?php

namespace App\Console\Commands;

use App\Models\Meeting\Announcement\Announcement;
use App\Models\Meeting\Meeting;
use Illuminate\Console\Command;
use Carbon\Carbon;

class TestAnnouncementCreate extends Command
{
    protected $signature = 'announcements:create-test';
    protected $description = 'Create a test announcement for testing notifications';

    public function handle(): void
    {
        // İlk meeting'i al
        $meeting = Meeting::first();
        
        if (!$meeting) {
            $this->error('No meetings found in database!');
            return;
        }
        
        $this->info('Creating test announcement for meeting: ' . $meeting->title);
        
        // 1 dakika sonrası için announcement oluştur
        $announcement = new Announcement();
        $announcement->meeting_id = $meeting->id;
        $announcement->title = 'Test Bildirim - ' . Carbon::now()->format('H:i:s');
        $announcement->status = 1;
        $announcement->is_published = 0;
        
        // Raw attributes kullanmak yerine fillable ile kaydet
        $announcement->fill([
            'meeting_id' => $meeting->id,
            'title' => 'Test Bildirim - ' . Carbon::now()->format('H:i:s'),
            'status' => 1,
            'is_published' => 0,
        ]);
        
        // publish_at için raw attribute kullan
        $announcement->setRawAttributes([
            'meeting_id' => $meeting->id,
            'title' => 'Test Bildirim - ' . Carbon::now()->format('H:i:s'),
            'status' => 1,
            'is_published' => 0,
            'publish_at' => Carbon::now()->addMinute()->format('Y-m-d H:i:s')
        ], true);
        
        if ($announcement->save()) {
            $this->info('Test announcement created successfully!');
            $this->info('ID: ' . $announcement->id);
            $this->info('Title: ' . $announcement->title);
            $this->info('Publish at: ' . $announcement->getRawOriginal('publish_at'));
            $this->info('Will be published in 1 minute...');
            
            // Participant sayılarını göster
            $this->info("\nParticipant counts:");
            $this->info('Agents: ' . $meeting->participants()->where('type', 'agent')->count());
            $this->info('Attendees: ' . $meeting->participants()->where('type', 'attendee')->count());
            $this->info('Teams: ' . $meeting->participants()->where('type', 'team')->count());
        } else {
            $this->error('Failed to create announcement!');
        }
    }
} 