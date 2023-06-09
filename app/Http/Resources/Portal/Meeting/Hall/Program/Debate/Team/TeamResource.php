<?php

namespace App\Http\Resources\Portal\Meeting\Hall\Program\Debate\Team;

use App\Models\Customer\Setting\Variable\Variable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TeamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'debate_id' => ['value'=>$this->debate_id, 'type'=>'hidden'],
            'code' => ['value'=>$this->code, 'type'=>'text'],
            'logo' => ['value'=>$this->logo, 'type'=>'file'],
            'title' => ['value'=>$this->title, 'type'=>'text'],
            'description' => ['value'=>$this->description, 'type'=>'text'],
            'route' => route('portal.team.update', $this->id),
        ];
    }
}
