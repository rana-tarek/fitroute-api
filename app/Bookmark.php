<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /* The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookmarks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'place_id'];

    public function users()
    {
        return $this->belongsToMany('App\AppUser');
    }

    public function places()
    {
        return $this->belongsToMany('App\Place');
    }
}
