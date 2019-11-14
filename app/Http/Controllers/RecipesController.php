<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Category;
use App\Ingredient;
use Session;
use App\Http\Resources\Recipe as RecipeResource;

class RecipesController extends Controller
{
    //
    public function index(){
        $recipes = Recipe::with('category')->orderBy('created_at','desc')->paginate(5);
        
        return RecipeResource::collection($recipes);
        //return view('recipes.index', compact('recipes'));
    }
    public function random(){
        $recipes = Recipe::with('category')->inRandomOrder()->paginate(3);
        return RecipeResource::collection($recipes);
    }
    public function show($id){
        $recipe = Recipe::with('category')->with('ingredient')->findOrFail($id);
        
        return new RecipeResource($recipe);
        //return view('recipes.show', ['recipe'=> $recipe,]);
    }

    public function create(){
        return view('recipes.create');
    }

    public function store(Request $request){

        // validate the data 

        $this->validate($request, array(
            'name' => 'required|max:255',
            'time' => 'required',
            'steps' => 'required',
        ));

        //store 
        $recipe = new Recipe;

        $recipe->name = $request->name;
        $recipe->time = $request->time;
        $recipe->steps = $request->steps;

        $recipe->save();
        error_log($recipe);

        Session::flash('success','Je hebt succesvol jouw project opgeslaan');
        //redirect
        return redirect()->route('recipes.index');
        
    }



    public function edit($id){

    }

    public function update(Request $request, $id){

    }
    
    public function destroy($id){
        
    }
}
