<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;

class DirectoryContact extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directory_contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'position', 'position_id', 'email', 'phone', 'social_network', 'description', 'directory_id', 
        'seq_no', 'is_active', 'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];
}