<?php

namespace App\Http\Resources\API\Meeting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'title' => $this->title,
            'banner_name' => $this->banner_name,
            'banner_extension' => $this->banner_extension,
            'start_at' => $this->start_at,
            'finish_at' => $this->finish_at,
            'hall_count' => $this->halls->count(),
            'first_hall_id' => $this->halls->first()->id,
            'status' => $this->status,
        ];
    }
}