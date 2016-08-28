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

Route::get('parsha/lists','ParshaController@show');
Route::get('parsha/new','ParshaController@index');
Route::get('parsha/edit/{id}','ParshaController@edit');
Route::get('parsha/delete/{id}','ParshaController@delete');
Route::post('parsha/create','ParshaController@create');
Route::post('parsha/update','ParshaController@update');

Route::get('section/lists','SectionController@show');
Route::get('section/new','SectionController@index');
Route::get('section/edit/{id}','SectionController@edit');
Route::get('section/delete/{id}','SectionController@delete');
Route::post('section/create','SectionController@create');
Route::post('section/update','SectionController@update');
Route::post('section/update-order','SectionController@updateOrder');

Route::get('text/{id}','ParshaController@detail');
Route::post('text/save','TextController@save');

Route::post('ajax-get-days','ParshaController@getDays');
Route::post('ajax-get-texts','ParshaController@getTexts');

Route::post('authenticate','CustomAuthController@authenticate');

