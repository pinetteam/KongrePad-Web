<?php

namespace App\Http\Resources\Portal\Meeting\Hall\Program\Session\Keypad;

use App\Models\Customer\Setting\Variable\Variable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class KeypadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'sesion_id' => 'required|exists:meeting_hall_program_sessions,id',
            'sort_order' => ['value'=>$this->sort_order, 'type'=>'number'],
            'code' => ['value'=>$this->code, 'type'=>'text'],
            'title' => ['value'=>$this->title, 'type'=>'text'],
            'voting_started_at' => ['value'=>Carbon::createFromFormat(Variable::where('variable','date_format')->first()->settings()->where('customer_id',Auth::user()->customer->id)->first()->value.' '.Variable::where('variable','time_format')->first()->settings()->where('customer_id',Auth::user()->customer->id)->first()->value, $this->voting_started_at)->format('d/m/Y H:i'), 'type'=>'datetime'],
            'voting_finished_at' => ['value'=>Carbon::createFromFormat(Variable::where('variable','date_format')->first()->settings()->where('customer_id',Auth::user()->customer->id)->first()->value.' '.Variable::where('variable','time_format')->first()->settings()->where('customer_id',Auth::user()->customer->id)->first()->value, $this->voting_finished_at)->format('d/m/Y H:i'), 'type'=>'datetime'],
            'on_vote' => ['value'=>$this->on_vote, 'type'=>'radio'],
            'status' => ['value'=>$this->status, 'type'=>'radio'],
            'route' => route('portal.keypad.update', $this->id),
        ];
    }
}