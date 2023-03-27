<?php

namespace App\Models\Customer;

use App\Models\Document\Document;
use App\Models\Meeting\Meeting;
use App\Models\Meeting\Hall\MeetingHall;
use App\Models\Participant\Participant;
use App\Models\User\Role\UserRole;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'title',
        'description',
        'icon',
        'logo',
        'policy_status',
        'language',
        'setting',
        'status',
        'deleted_by',
    ];
    protected $dates = [
        'deleted_at',
    ];
    protected $casts = [
        'setting' => 'array',
    ];
    public function documents()
    {
        $documents = Document::select('documents.*')->join('participants', 'documents.participant_id', '=', 'participants.id')
            ->join('meetings', 'participants.meeting_id', '=', 'meetings.id')
            ->join('customers', 'meetings.customer_id', '=', 'customers.id')
            ->where('customers.id', $this->getkey());
        return $documents;
    }
    public function participants()
    {
        return $this->hasOneThrough(Participant::class, Meeting::class, 'customer_id', 'meeting_id', 'id', 'id');
    }
    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'customer_id', 'id');
    }
    public function meetingHalls()
    {
        return $this->hasOneThrough(MeetingHall::class, Meeting::class, 'customer_id', 'meeting_id', 'id', 'id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'customer_id', 'id');
    }
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'customer_id', 'id');
    }
}