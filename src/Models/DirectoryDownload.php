<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectoryDownload extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directory_downloads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'position', 'description', 'document_id', 'directory_library_id',
        'directory_id', 'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function document(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Media','document_id');
    }

    public function directory(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Directory','directory_id');
    }

    public function directoryLibrary(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\DirectoryLibrary','directory_library_id');
    }
}