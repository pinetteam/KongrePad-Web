<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Meeting\Document\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FixDocumentFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'documents:fix-files {--check : Only check without fixing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix document file names and check for missing files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $checkOnly = $this->option('check');
        
        $this->info('Checking document files...');
        
        $documents = Document::all();
        $missingCount = 0;
        $fixedCount = 0;
        
        foreach ($documents as $document) {
            $filePath = 'public/documents/' . $document->file_name . '.' . $document->file_extension;
            
            if (!Storage::exists($filePath)) {
                $this->error("Missing file: {$document->file_name}.{$document->file_extension} (ID: {$document->id}, Title: {$document->title})");
                $missingCount++;
                
                // UUID formatındaki dosyayı ara
                if (strlen($document->file_name) == 36) {
                    $files = Storage::files('public/documents');
                    foreach ($files as $file) {
                        if (str_contains($file, $document->file_name)) {
                            $this->info("Found UUID file: {$file}");
                            break;
                        }
                    }
                }
                
                // Yeni format için eksik dosyayı ara
                if (!$checkOnly) {
                    // Aynı boyuttaki dosyayı bul
                    $files = Storage::files('public/documents');
                    foreach ($files as $file) {
                        if (Storage::size($file) == $document->file_size) {
                            $this->info("Found file with same size ({$document->file_size} bytes): {$file}");
                            
                            if ($this->confirm("Copy this file for document ID {$document->id}?")) {
                                $newPath = 'public/documents/' . $document->file_name . '.' . $document->file_extension;
                                Storage::copy($file, $newPath);
                                $this->info("Copied: {$file} -> {$newPath}");
                                $fixedCount++;
                            }
                            break;
                        }
                    }
                }
            } else {
                $this->line("OK: {$document->file_name}.{$document->file_extension}");
            }
        }
        
        $this->info("\nSummary:");
        $this->info("Total documents: " . $documents->count());
        $this->info("Missing files: {$missingCount}");
        
        if (!$checkOnly && $fixedCount > 0) {
            $this->info("Fixed files: {$fixedCount}");
        }
        
        return Command::SUCCESS;
    }
} 