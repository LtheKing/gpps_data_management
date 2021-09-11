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
