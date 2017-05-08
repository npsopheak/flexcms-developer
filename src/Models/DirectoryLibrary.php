<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectoryLibrary extends Model
{
    use SoftDeletes;
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
        'name', 'type_id', 'description', 'directory_id', 'document_english_id',
        'document_khmer_id', 'document_english_download', 'document_khmer_download',
        'seq_no', 'is_active', 'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function documentEnglish(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Media','document_english_id');
    }

    public function documentKhmer(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Media','document_khmer_id');
    }

    public function type(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Item','type_id');
    }

    public function directory(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Directory','directory_id');
    }
}