<?php

namespace App\Models\Meeting\Document;

use App\Models\Meeting\Hall\Program\Session\Session;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    protected $table = 'meeting_documents';
    protected $fillable = [
        'meeting_id',
        'file_name',
        'file_extension',
        'file_size',
        'title',
        'sharing_via_email',
        'allowed_to_review',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function getCreatedByNameAttribute()
    {
        return isset($this->created_by) ? User::findOrFail($this->created_by)->full_name : __('common.unspecified');
    }
    
    /**
     * Get the file URL attribute
     */
    public function getFileUrlAttribute()
    {
        if ($this->file_name && $this->file_extension) {
            $filePath = 'public/documents/' . $this->file_name . '.' . $this->file_extension;
            if (\Storage::exists($filePath)) {
                return url('storage/documents/' . $this->file_name . '.' . $this->file_extension);
            }
        }
        return null;
    }
    
    /**
     * Get the download URL attribute
     */
    public function getDownloadUrlAttribute()
    {
        if ($this->file_name && $this->file_extension) {
            $filePath = 'public/documents/' . $this->file_name . '.' . $this->file_extension;
            if (\Storage::exists($filePath)) {
                return route('api.v1.document.download', $this->id);
            }
        }
        return null;
    }
    
    /**
     * Check if file exists
     */
    public function getFileExistsAttribute()
    {
        if ($this->file_name && $this->file_extension) {
            return \Storage::exists('public/documents/' . $this->file_name . '.' . $this->file_extension);
        }
        return false;
    }
    
    public function sessions()
    {
        return $this->hasMany(Session::class, 'document_id', 'id');
    }
}
