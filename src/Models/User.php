<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'title', 'description', 'photo_url', 'role'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'access_token', 'expires_in', 'is_login', 'site_id', 'created_at', 'deleted_at'];
    protected $dates = ['deleted_at'];

    public function profile()
    {
        return $this->hasOne('FlexCMS\BasicCMS\Models\Profile','user_id');
    }

    public function site(){

        return $this->hasMany('FlexCMS\BasicCMS\Models\Site','user_id');
    }

    public function article(){

        return $this->hasMany('FlexCMS\BasicCMS\Models\Article','user_id');
    }

    public function tag(){
        return $this->hasMany('FlexCMS\BasicCMS\Models\Tag','tag_id');
    }

    public function item(){
        return $this->hasMany('FlexCMS\BasicCMS\Models\Item','item_id');
    }

    public function directory()
    {
        return $this->belongsToMany('FlexCMS\BasicCMS\Models\Directory', 'directory_users', 'user_id', 'directory_id');
    }
}
