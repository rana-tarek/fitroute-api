<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gallery';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image', 'place_id'];

    public function place()
    {
        return $this->belongsTo('App\Place');
    }
}
