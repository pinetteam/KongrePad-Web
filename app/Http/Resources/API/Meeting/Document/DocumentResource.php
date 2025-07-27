<?php

namespace App\Http\Resources\API\Meeting\Document;

use App\Http\Resources\API\Meeting\Hall\Program\Session\SessionResource;
use App\Models\Meeting\Document\Mail\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Dosya yolunu kontrol et
        $filePath = 'public/documents/' . $this->file_name . '.' . $this->file_extension;
        $fileExists = \Storage::exists($filePath);
        
        // Eğer dosya bulunamazsa, farklı timestamp formatlarını dene
        if (!$fileExists && strlen($this->file_name) > 10) {
            // Orijinal dosya adını al (timestamp'siz)
            $baseFileName = substr($this->file_name, 0, -3); // Son 3 karakteri (Hi formatı) çıkar
            $baseFileNameLong = substr($this->file_name, 0, -6); // Son 6 karakteri (His formatı) çıkar
            
            // Storage'daki tüm dosyaları kontrol et
            $files = \Storage::files('public/documents');
            foreach ($files as $file) {
                // Dosya adı prefix'i ile eşleşiyor mu kontrol et
                if (str_contains($file, $baseFileName) || str_contains($file, $baseFileNameLong)) {
                    // Dosya boyutu da eşleşiyor mu kontrol et
                    if (\Storage::size($file) == $this->file_size) {
                        // Eşleşen dosyayı bulduk, kopyala
                        $newPath = 'public/documents/' . $this->file_name . '.' . $this->file_extension;
                        \Storage::copy($file, $newPath);
                        $fileExists = true;
                        break;
                    }
                }
            }
        }
        
        return [
            'id' => $this->id,
            'meeting_id' => $this->meeting_id,
            'title' => $this->title,
            'session' => new SessionResource($this->sessions->first()),
            'is_requested' => Mail::where([['participant_id', $request->user()->id], ['document_id', $this->id]])->count() > 0,
            'file_name' => $this->file_name,
            'file_extension' => $this->file_extension,
            'file_url' => ($this->allowed_to_review && $fileExists) ? url('storage/documents/' . $this->file_name . '.' . $this->file_extension) : null,
            'download_url' => ($this->allowed_to_review && $fileExists) ? route('api.v1.document.download', $this->id) : null,
            'file_exists' => $fileExists,
            'allowed_to_review' => $this->allowed_to_review,
            'sharing_via_email' => $this->sharing_via_email,
            'status' => $this->status,
        ];
    }
}
