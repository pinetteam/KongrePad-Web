<?php

namespace App\Models\Meeting\Hall\Program\Debate;

use App\Models\Customer\Setting\Variable\Variable;
use App\Models\Meeting\Hall\Program\Debate\Vote\Vote;
use App\Models\Meeting\Hall\Program\Program;
use App\Models\Meeting\Hall\Program\Debate\Team\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Debate extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'meeting_hall_program_debates';
    protected $fillable = [
        'sort_order',
        'program_id',
        'code',
        'title',
        'description',
        'voting_started_at',
        'voting_finished_at',
        'on_vote',
        'status',
        'created_by',
        'edited_by',
        'deleted_by',
    ];
    protected $dates = [
        'voting_started_at',
        'voting_finished_at',
        'deleted_at',
    ];
    protected $casts = [
        'voting_started_at' => 'datetime',
        'voting_finished_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    protected function votingStartedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($startAt) => $startAt ? Carbon::createFromFormat('Y-m-d H:i:s', $startAt)->format(Variable::where('variable','date_format')->first()->settings()->where('customer_id',Auth::user()->customer->id)->first()->value.' '.Variable::where('variable','time_format')->first()->settings()->where('customer_id',Auth::user()->customer->id)->first()->value) : null,
            set: fn ($startAt) => $startAt ? Carbon::createFromFormat('Y-m-d H:i', $startAt)->format('Y-m-d H:i:s') : null,
        );
    }
    protected function votingFinishedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($finishAt) => $finishAt ? Carbon::createFromFormat('Y-m-d H:i:s', $finishAt)->format(Variable::where('variable','date_format')->first()->settings()->where('customer_id',Auth::user()->customer->id)->first()->value.' '.Variable::where('variable','time_format')->first()->settings()->where('customer_id',Auth::user()->customer->id)->first()->value) : null,
            set: fn ($finishAt) => $finishAt ? Carbon::createFromFormat('Y-m-d H:i', $finishAt)->format('Y-m-d H:i:s') : null,
        );
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Team::class, 'debate_id', 'team_id', 'id', 'id');

    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'debate_id', 'id');
    }
}
