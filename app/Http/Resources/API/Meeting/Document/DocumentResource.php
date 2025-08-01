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
        return [
            'id' => $this->id,
            'meeting_id' => $this->meeting_id,
            'title' => $this->title,
            'session' => new SessionResource($this->sessions->first()),
            'is_requested' => Mail::where([['participant_id', $request->user()->id], ['document_id', $this->id]])->count() > 0,
            'file_name' => $this->file_name,
            'file_extension' => $this->file_extension,
            'file_url' => $this->allowed_to_review ? $this->file_url : null,
            'download_url' => $this->allowed_to_review ? $this->download_url : null,
            'file_exists' => $this->file_exists,
            'allowed_to_review' => $this->allowed_to_review,
            'sharing_via_email' => $this->sharing_via_email,
            'status' => $this->status,
        ];
    }
}
