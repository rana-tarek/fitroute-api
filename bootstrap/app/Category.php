<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'icon', 'description'];

    public function subcategories()
    {
        return $this->belongsToMany('App\Subcategory', 'category_subcategory')->with('facilities');
    }

}
