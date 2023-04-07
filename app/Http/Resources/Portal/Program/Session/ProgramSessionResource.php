<?php

namespace App\Http\Resources\Portal\Program\Session;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProgramSessionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'program_id' => ['value'=>$this->program_id, 'type'=>'hidden'],
            'presenter_id' => ['value'=>$this->presenter_id, 'type'=>'select'],
            'document_id' => ['value'=>$this->document_id, 'type'=>'select'],
            'sort_id' => ['value'=>$this->sort_id, 'type'=>'number'],
            'code' => ['value'=>$this->code, 'type'=>'text'],
            'title' => ['value'=>$this->title, 'type'=>'text'],
            'description' => ['value'=>$this->description, 'type'=>'text'],
            'start_at' => ['value'=>Carbon::createFromFormat(Auth::user()->customer->settings['date-format'].' '.Auth::user()->customer->settings['time-format'], $this->start_at)->format('d/m/Y H:i'), 'type'=>'datetime'],
            'finish_at' => ['value'=>Carbon::createFromFormat(Auth::user()->customer->settings['date-format'].' '.Auth::user()->customer->settings['time-format'], $this->finish_at)->format('d/m/Y H:i'), 'type'=>'datetime'],
            'questions' => ['value'=>$this->questions, 'type'=>'radio'],
            'question_limit' => ['value'=>$this->question_limit, 'type'=>'number'],
            'status' => ['value'=>$this->status, 'type'=>'radio'],
            'route' => route('portal.program-session.update', $this->id),
        ];
    }
}