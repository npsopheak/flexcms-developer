<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','user_id','logo_id','website','supports'];
    
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('FlexCMS\BasicCMS\Models\User','user_id');
    }

    public function logo(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Media','logo_id');
    }
}
