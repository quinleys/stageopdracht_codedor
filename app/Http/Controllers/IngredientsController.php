<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\Recipe;
use App\Http\Resources\Ingredient as IngredientResource;

class IngredientsController extends Controller
{
    public function index(){
        $ingredients = Ingredient::with('recipe')->orderBy('created_at','desc')->paginate(5);

        return IngredientResource::collection($ingredients);
        //return view('ingredients.index', compact('ingredients'));
    }

    public function create(){
        return view('ingredients.create');
    }

    public function store(Request $request){

        // validate the data 

        $this->validate($request, array(
            'title' => 'required|max:255',
            'unit' => 'required',
        ));

        //store 
        $ingredient = new Ingredient;

        $ingredient->title = $request->title;
        $ingredient->unit = $request->unit;

        $ingredient->save();

        //redirect
        return redirect()->route('ingredients.index');
        
    }
    public function show($id){
        $ingredient = Ingredient::with('recipe')->findOrFail($id);
        
        return new IngredientResource($ingredient);
    }
    
}
