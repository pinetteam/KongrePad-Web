<?php

namespace App\Console\Commands;

use App\Models\Meeting\Announcement\Announcement;
use Illuminate\Console\Command;
use Carbon\Carbon;

class TestAnnouncementPublish extends Command
{
    protected $signature = 'announcements:test';
    protected $description = 'Test announcement publishing system';

    public function handle(): void
    {
        $this->info('Testing announcement system...');
        
        // Tüm duyuruları göster
        $announcements = Announcement::all();
        
        if ($announcements->isEmpty()) {
            $this->error('No announcements found!');
            return;
        }
        
        $this->table(
            ['ID', 'Title', 'Publish At', 'Is Published', 'Status'],
            $announcements->map(function ($ann) {
                return [
                    $ann->id,
                    $ann->title,
                    $ann->getRawOriginal('publish_at'),
                    $ann->is_published ? 'YES' : 'NO',
                    $ann->status ? 'Active' : 'Passive'
                ];
            })
        );
        
        // Yayınlanması gereken duyuruları kontrol et
        $now = Carbon::now();
        $shouldPublish = Announcement::where('publish_at', '<=', $now)
            ->where('is_published', 0)
            ->where('status', 1)
            ->get();
            
        if ($shouldPublish->isNotEmpty()) {
            $this->info("\nAnnouncements that should be published:");
            foreach ($shouldPublish as $ann) {
                $this->line("- ID: {$ann->id}, Title: {$ann->title}");
            }
            
            if ($this->confirm('Do you want to publish these announcements now?')) {
                $this->call('announcements:publish');
            }
        } else {
            $this->info("\nNo announcements pending publication.");
        }
        
        // Cron job durumu
        $this->info("\nCron job status:");
        $this->line("The cron job should run every minute: * * * * * php artisan schedule:run");
        $this->line("Make sure cron is set up on the server!");
    }
} 