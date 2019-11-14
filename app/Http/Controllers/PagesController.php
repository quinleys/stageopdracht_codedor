<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;

class PagesController extends Controller
{
    public function getIndex() {
        $recipes = Recipe::all();
        return view('welcome', ['recipes'=>$recipes]);
    }
    public function getDetail($id) {
        $recipe = Recipe::findOrFail($id);
        return view ('detail', ['recipe'=> $recipe]);
    }
    public function getOverview(){
        $recipes = Recipe::all();
        return view('overview', ['recipes'=>$recipes]);
    }
    public function getIngredient(){
        return view('ingredient');
    }
    public function getIngredientDetail($id) {
        $ingredient = Ingredient::findOrFail($id);
        return view ('ingredientDetail', ['ingredient'=> $ingredient]);
    }
}
