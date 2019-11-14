<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\Category as CategoryResource;
class CategoriesController extends Controller
{
    public function index(){

        
        $categories = Category::orderBy('created_at','desc')->paginate(5);
        return CategoryResource::collection($categories);
        //return view('categories.index', compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
         // validate the data 

         $this->validate($request, array(
            'title' => 'required|max:255',
            'synopsis' => 'required',
        ));

        //store 
        $category = new Category;

        $category->title = $request->title;
        $category->synopsis = $request->synopsis;

        $category->save();

        //redirect
        return redirect()->route('categories.index');
    }
}
