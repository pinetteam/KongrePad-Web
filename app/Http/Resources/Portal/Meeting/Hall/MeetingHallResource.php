<?php

namespace App\Http\Resources\Portal\Meeting\Hall;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingHallResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'meeting_id' => ['value'=>$this->meeting_id, 'type'=>'select'],
            'title' => ['value'=>$this->title, 'type'=>'text'],
            'status' => ['value'=>$this->status, 'type'=>'radio'],
            'route' => route('portal.meeting-hall.update', $this->id),
        ];
    }
}
