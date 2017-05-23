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

Route::get('/', function () {
    return view('welcome');
});
Route::get('athletes', 'AthleteControllers@index');
Route::get('countries', 'CountriesController@index');
Route::get('branch_sports', 'BranchSportController@index');
Route::get('tour', 'TourController@index');
// Route::get('nearby_competition', 'BranchSportController@nearby_competition');
Route::post('nearby_competition', 'BranchSportController@nearby_competition');
Route::post('nearby_tour', 'TourController@nearby_competition');
