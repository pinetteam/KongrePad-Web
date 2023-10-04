<?php

namespace App\Http\Resources\API\Meeting\Hall\Program\Debate\Team;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sort_order' => $this->sort_order,
            'debate_id' => $this->debate_id,
            'code' => $this->code,
            'logo' => $this->logo,
            'title' => $this->title,
            'description' => $this->description,
            ];
    }
}