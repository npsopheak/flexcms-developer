<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleProduct extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'article_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'product_id'];
           
    protected $dates = ['deleted_at'];

    public function product (){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Item','product_id');
    }
}
