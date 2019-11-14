<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@getIndex');
Route::get('detail/{id}', 'PagesController@getDetail');
Route::get('overview', 'PagesController@getOverview');
Route::get('ingredient', 'PagesController@getIngredient');
Route::get('ingredient/{id}', 'PagesController@getIngredientDetail');

//recipes
Route::resource('recipes', 'RecipesController');

//ingredients
Route::resource('ingredients', 'IngredientsController');

//categories
Route::resource('categories', 'CategoriesController');

Auth::routes();

