<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // UUID formatındaki dosyaları bul ve düzelt
        $documents = DB::table('meeting_documents')
            ->whereNull('deleted_at')
            ->get();
            
        foreach ($documents as $document) {
            $oldFileName = $document->file_name . '.' . $document->file_extension;
            $oldPath = 'public/documents/' . $oldFileName;
            
            // Eğer dosya UUID formatındaysa (36 karakter)
            if (strlen($document->file_name) == 36 && strpos($document->file_name, '-') !== false) {
                // Yeni dosya adı oluştur
                $title_slug = \Str::slug($document->title, '-');
                $timestamp = date('Ymd-His', strtotime($document->created_at));
                $newFileName = "meeting{$document->meeting_id}-{$title_slug}-{$timestamp}";
                $newFullName = $newFileName . '.' . $document->file_extension;
                $newPath = 'public/documents/' . $newFullName;
                
                // Dosya varsa yeniden adlandır
                if (Storage::exists($oldPath)) {
                    Storage::move($oldPath, $newPath);
                    
                    // Database'i güncelle
                    DB::table('meeting_documents')
                        ->where('id', $document->id)
                        ->update(['file_name' => $newFileName]);
                        
                    echo "Renamed: {$oldFileName} -> {$newFullName}\n";
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Geri alma işlemi için boş bırakıyoruz
    }
}; 