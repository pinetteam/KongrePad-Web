<?php

namespace App\Models\Meeting\Document\Mail;

use App\Models\Customer\Customer;
use App\Models\Meeting\Document\Document;
use App\Models\Meeting\Participant\Participant;
use App\Models\System\Setting\Variable\Variable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Mail extends Model
{
    protected $table = 'meeting_document_mails';
    protected $fillable = [
        'document_id',
        'participant_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected function createdAt(): Attribute
    {
        $date_time_format = Variable::where('variable', 'date_time_format')->first()->settings()->where('customer_id', Auth::user()->customer->id ?? Customer::first()->id)->first()->value;

        return Attribute::make(
            get: fn ($createdAt) => $createdAt ? Carbon::createFromFormat('Y-m-d H:i:s', $createdAt)->format($date_time_format) : null,
            );
    }
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id', 'id');
    }
}
