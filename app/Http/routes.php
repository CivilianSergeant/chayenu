<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','CustomAuthController@index');
Route::get('logout','CustomAuthController@logout');

Route::get('dashboard','DashboardController@index');
Route::get('parsha/{id?}','ParshaController@detail');
Route::get('section','SectionController@index');

Route::post('authenticate','CustomAuthController@authenticate');

