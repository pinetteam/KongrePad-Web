<?php

namespace App\Models\Customer\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'customer_settings';
    protected $fillable = [
        'customer_id',
        'variable_id',
        'value',
        'created_by',
        'updated_by',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
