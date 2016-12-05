<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'places';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'subcategory_id', 'rate', 'latitude', 'longitude', 'address', 'thumbnail', 'working_from', 'working_to'];

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function gallery()
    {
        return $this->hasMany('App\Gallery');
    }

    public function facilities()
    {
        return $this->belongsToMany('App\Facility', 'place_facility');
    }
}
