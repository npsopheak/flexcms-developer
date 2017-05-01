<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;

class DirectoryBudget extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directory_budgets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year', 'short_description', 'org_budget', 'project_cost', 'admin_cost', 'other_cost', 'directory_id', 
        'edu_project_cost', 'seq_no', 'is_active', 'created_by', 'updated_by', 'deleted_by',
        'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];
}