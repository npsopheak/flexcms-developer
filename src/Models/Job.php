<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_careers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'job_term', 'location', 'closing_date', 'experience', 'number_hire', 
        'qualification', 'description', 'age_from', 'age_to', 'gender', 
        'responsibility', 'requirement', 'seq_no',
        'is_active', 'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];
}