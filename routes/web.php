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

Route::get('contact/autocomplete', [
		'uses' => 'ContactController@autocomplete',
		'as' => 'contact.autocomplete'
	]);
Route::resource('contact', 'ContactController');

Route::post('groups/store', [
		'uses' => 'GroupsController@store',
		'as'=> 'groups.store'
	]);
