<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function ingredient(){
        return $this->belongsToMany('App\Ingredient');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}
