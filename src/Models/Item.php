<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','display_name','description','locale','item_type','article_count','parent_id','photo_id','seq_number','created_by','updated_by','deleted_by', 'status'];

    protected $dates = ['deleted_at'];

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getLocaleAttribute($value)
    {
        if ($value && is_string($value)){
            try{
                return json_decode($value);    
            }
            catch(\Exception $e){
                return $value;
            }
            
        }
        else{
            return $value;
        }
    }

    public function item(){
        $this->belongsTo('App\Item','parent_id');
    }

    public function type(){
        return $this->belongsTo('App\Item', 'parent_id');
    }

    public function photo(){
        $this->belongsTo('App\Media','photo_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function directories()
    {
        return $this->belongsToMany('App\Directory', 'directory_categories', 'category_id', 'directory_id');
    }

    public function sections(){
        return $this->hasMany('App\ProductSection', 'product_id');
    }
}
