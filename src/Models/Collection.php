<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'hash', 'description', 'created_by', 'updated_by', 'status', 'locale'];
           
    protected $dates = ['deleted_at'];

    public function articles (){
        return $this->hasMany('App\Article', 'collection_id');
    }
}
