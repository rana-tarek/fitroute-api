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
    protected $table = 'sub_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function facilities()
    {
        return $this->belongsToMany('App\Facility', 'subcategory_facility');
    }
}
