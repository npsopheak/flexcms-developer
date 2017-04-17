<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSection extends Model
{
    //
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_sections';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'article_section_id'];
           
    protected $dates = ['deleted_at'];

    public static $rules = array(
        'product_id'=>'required',
        'article_section_id'=>'required'
    );

    public static function validate($data, $rules = null) {
        return Validator::make($data, $rules == null ? static::$rules : $rules);
    }

    public function articleSection(){
        return $this->belongsTo('App\Article', 'article_section_id');
    }

    public function products(){
        return $this->belongsToMany('App\Item', 'product_id');
    }
}
