<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subcategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function facilities()
    {
        return $this->belongsToMany('App\Facility', 'subcategory_facility');
    }
}
