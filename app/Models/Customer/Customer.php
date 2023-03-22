<?php

namespace App\Models\Customer;

use App\Models\Meeting\Meeting;
use App\Models\Meeting\Room\MeetingRoom;
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
    ];
    protected $dates = [
        'deleted_at',
    ];
    protected $casts = [
        'setting' => 'array',
    ];
    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'customer_id', 'id');
    }
    public function meetingRooms()
    {
        return $this->hasOneThrough(MeetingRoom::class, Meeting::class, 'customer_id', 'meeting_id', 'id', 'id');
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
