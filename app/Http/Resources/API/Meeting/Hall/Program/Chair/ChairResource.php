<?php

namespace App\Http\Resources\API\Meeting\Hall\Program\Chair;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChairResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sort_order' => $this->sort_order,
            'chair_id' => $this->chair_id,
            'type' => $this->type,
            'chair' => $this->chair()->first_name,
        ];
    }
}
