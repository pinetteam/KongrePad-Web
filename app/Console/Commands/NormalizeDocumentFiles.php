<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Meeting\Document\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NormalizeDocumentFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'documents:normalize {--dry-run : Show what would be changed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Normalize all document file names to standard format';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->info('DRY RUN MODE - No changes will be made');
        }
        
        $this->info('Normalizing document file names...');
        
        $documents = Document::all();
        $normalizedCount = 0;
        $errorCount = 0;
        
        foreach ($documents as $document) {
            $oldPath = 'public/documents/' . $document->file_name . '.' . $document->file_extension;
            
            // Generate new normalized name
            $title_slug = Str::slug($document->title, '-');
            $newFileName = "meeting{$document->meeting_id}-{$title_slug}";
            
            // Check if file needs renaming
            if ($document->file_name === $newFileName) {
                $this->line("✓ Already normalized: {$document->file_name}");
                continue;
            }
            
            // Check if old file exists
            if (!Storage::exists($oldPath)) {
                $this->error("✗ File not found: {$oldPath}");
                $errorCount++;
                continue;
            }
            
            // Handle duplicate names
            $counter = 1;
            $finalFileName = $newFileName;
            $newPath = 'public/documents/' . $finalFileName . '.' . $document->file_extension;
            
            while (Storage::exists($newPath) && $newPath !== $oldPath) {
                $finalFileName = $newFileName . '-' . $counter;
                $newPath = 'public/documents/' . $finalFileName . '.' . $document->file_extension;
                $counter++;
            }
            
            if ($dryRun) {
                $this->info("Would rename: {$document->file_name} → {$finalFileName}");
            } else {
                // Rename file
                if (Storage::move($oldPath, $newPath)) {
                    // Update database
                    $document->file_name = $finalFileName;
                    $document->save();
                    
                    $this->info("✓ Renamed: {$oldPath} → {$newPath}");
                    $normalizedCount++;
                } else {
                    $this->error("✗ Failed to rename: {$oldPath}");
                    $errorCount++;
                }
            }
        }
        
        $this->info("\nSummary:");
        $this->info("Total documents: " . $documents->count());
        
        if ($dryRun) {
            $this->info("Would normalize: {$normalizedCount} files");
        } else {
            $this->info("Normalized: {$normalizedCount} files");
        }
        
        if ($errorCount > 0) {
            $this->error("Errors: {$errorCount}");
        }
        
        return Command::SUCCESS;
    }
} 