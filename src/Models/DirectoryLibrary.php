<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;

class DirectoryLibrary extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directory_libraries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'type_id', 'description', 'directory_id', 'document_english_id',
        'document_khmer_id', 'document_english_download', 'document_khmer_download',
        'seq_no', 'is_active', 'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];
}