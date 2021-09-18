<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JemaatController;


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

//user
Route::post('/user/login', 'UserController@login')->name('user_login');

//jemaat
Route::get('/jemaat/index', 'JemaatController@index')->name('jemaat_index');
Route::get('/jemaat/create', 'JemaatController@create')->name('jemaat_create');
Route::post('/jemaat/store', 'JemaatController@store')->name('jemaat_store');
Route::get('/jemaat/edit/{id}', 'JemaatController@edit')->name('jemaat_edit');
Route::get('/jemaat/detail/{id}', 'JemaatController@show')->name('jemaat_detail');
Route::put('/jemaat/update/{id}', 'JemaatController@update')->name('jemaat_update');
Route::delete('/jemaat/delete/{id}', 'JemaatController@destroy')->name('jemaat_destroy');

//testing
Route::get('testing/playground', function(){
    return view('testing.playground');
});

Route::get('testing/alert', function(){
    return redirect('/testing/playground')->with('status', 'this is alert');
});

