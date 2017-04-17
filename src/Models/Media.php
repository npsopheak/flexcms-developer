<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Validator;

class Media extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['imagable_id','imagable_type',
        'file_name','path_name','storage_type',
        'type','mime_type','content_length','user_id', 'site_id',
        'caption', 'description', 'album_id', 'seq_no', 'is_best_video', 'is_home_image', 
        'link'];

    protected $dates = ['deleted_at'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public static $rules = array(
        'imagable_type'=>'required',
        'imagable_id'=>'required',
        // 'file_name'=>'required',
        // 'path_name'=>'required',
        // 'user_id'=>'required|exists:users,id',
        // 'site_id'=>'required|exists:sites,id',
        // 'storage_type'=>'required'
    );

    public function getFileNameAttribute($value)
    {
        if ($this->attributes['storage_type'] === 'local'){
            if (env('DOMAIN')){
                return env('DOMAIN') . $this->attributes['path_name'] . '/' . $value;
            }
            else{
                return '/' . $this->attributes['path_name'] . '/' . $value;    
            }
            
        }
        else{
            return $value;
        }
    }

    public static function validate($data, $rules = null) {
        return Validator::make($data, $rules == null ? static::$rules : $rules);
    }

    public function album(){
        return $this->belongsTo('App\Item','album_id');
    }
    
    public function article(){
        return $this->belongsTo('App\Article', 'imagable_id');
    }
}
