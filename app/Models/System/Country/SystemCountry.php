<?php

namespace App\Models\System\Country;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SystemCountry extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'system_countries';
    protected $fillable = [
        'name',
        'code',
        'short_name_2d',
        'short_name_3d',
        'phone_code',
    ];
    protected $dates = [
        'deleted_at',
    ];
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
    public function getNameAndCodeAttribute()
    {
        return Str::of($this->name . " | +". $this->phone_code)->trim();
    }
}
