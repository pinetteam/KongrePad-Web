<?php

namespace App\Models\Document;

use App\Models\Participant\Participant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'documents';
    protected $fillable = [
        'participant_id',
        'file_name',
        'file_extension',
        'title',
        'sharing_via_email',
        'type',
        'status',
        'deleted_by',
    ];
    protected $dates = [
        'deleted_at',
    ];
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id', 'id');
    }
}
