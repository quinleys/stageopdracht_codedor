<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function recipe(){
        return $this->belongsToMany('App\Recipe', 'ingredient_recipe','ingredient_id','recipe_id');
    }
}
