<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;

class DirectoryStaff extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directory_staffs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role', 'role_id', 'email', 'phone', 'description', 'directory_id', 
        'user_id', 'seq_no', 'is_active', 'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];
}
