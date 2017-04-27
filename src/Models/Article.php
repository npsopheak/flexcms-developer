<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description', 'hash',
        'primary_photo_id', 'category_id', 'organization_id',
        'type_id', 'created_by', 'updated_by', 'deleted_by',
        'language', 'parent_id', 'customs', 'seq_no', 'published_at', 'scheduled_at', 'status',
        'game_photo_id', 'collection_id', 'short_description'];
    
    protected $dates = ['deleted_at'];
    /**
     * Get the custom field attributes
     *
     * @param  string  $value
     * @return string
     */
    public function getCustomsAttribute($value)
    {
        if ($value && is_string($value)){
            try{
                $tmp = json_decode($value, true);    
                $field = [];
                foreach ($tmp as $key => $value) {
                    $field[$value['name']] = $value;
                }
                return $field;
            }
            catch(\Exception $e){
                return $value;
            }
            
        }
        else{
            return $value;
        }
    }

    // public function photos(){
    //     return $this->morphMany('FlexCMS\BasicCMS\Models\Media', 'imageable');
    // }

    public function category(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Item','category_id');
    }

    public function type(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Item','type_id');
    }

    public function articleTag(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\articleTag','tag_id');
    }

    public function collection(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Collection','collection_id');
    }

    public function photos(){
        return $this->hasMany('FlexCMS\BasicCMS\Models\Media', 'imagable_id')->where('imagable_type', '=', 'Article')->where('type', '=', 'gallery');
    }

    public function primaryMedia(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Media', 'primary_photo_id');
    }

    public function gamePoster(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Media', 'game_photo_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function tags()
    {
        return $this->belongsToMany('FlexCMS\BasicCMS\Models\Item', 'article_tags', 'article_id', 'tag_id');
    }

    public function products()
    {
        return $this->belongsToMany('FlexCMS\BasicCMS\Models\Item', 'article_products', 'article_id', 'product_id');
    }

    public function createdByUser(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\User', 'created_by');
    }

    public function localizations(){
        return $this->hasMany('FlexCMS\BasicCMS\Models\Article', 'parent_id');
    }


}
