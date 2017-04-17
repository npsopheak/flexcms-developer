<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sender_name', 'sender_phone', 'sender_email', 
    	'created_by', 'updated_by', 'status', 'is_read', 'is_seen'];
           
    protected $dates = ['deleted_at'];

    public static $rules = array(
        'sender_name'=>'required',
        'sender_phone'=>'required',
        'sender_email'=>'required'
    );

    public static function validate($data, $rules = null) {
        return Validator::make($data, $rules == null ? static::$rules : $rules);
    }
}
