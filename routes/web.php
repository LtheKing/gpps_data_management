<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JemaatController;
use Illuminate\Support\Facades\DB;
use App\Models\Cabang;



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
    $cabangs = DB::table('cabangs')->get();
    // dd($cabangs);
    return view('welcome', compact('cabangs'));
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
Route::post('/jemaat/absen/{id}', 'JemaatController@absen')->name('jemaat_absen');

//api
Route::get('/api/token', function() {
    return csrf_token();
});
Route::get('/jemaat/array', 'JemaatController@getJemaatArray')->name('jemaat_array');
Route::delete('/api/jemaat/delete/{id}', 'JemaatController@api_delete')->name('jemaat_api_delete');
Route::get('/api/jemaat/ayah/{nama}', 'JemaatController@getAyah')->name('jemaat_get_ayah');
Route::get('/api/jemaat/ibu/{nama}', 'JemaatController@getIbu')->name('jemaat_get_ibu');
Route::get('/api/jemaat/filter/{field}/{value}', 'JemaatController@filter')->name('jemaat_filter');
Route::get('/api/jemaat/suami/{nama}', 'JemaatController@getSuami')->name('jemaat_get_suami');
Route::get('/api/jemaat/istri/{nama}', 'JemaatController@getIstri')->name('jemaat_get_istri');


//testing
Route::get('testing/playground', function(){
    return view('testing.playground');
});

Route::get('testing/qrcode', function () {
  
    QrCode::size(500)
            ->format('png')
            ->generate(route('jemaat_detail', 16), Storage::disk('local')->put('public/images/qrcode.png', 'public'));
    
    return view('testing.qrcode');  
});

Route::get('testing/alert', function(){
    return redirect('/testing/playground')->with('status', 'this is alert');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/testing/pdf', function() {
    $qrcode = QrCode::size(125)->generate('ItSolutionStuff.com');
    
    // $pdf = PDF::loadView('testing.testing_pdf', compact('qrcode'));
    $pdf = PDF::loadView('testing.qrcode');

    //Aktifkan Local File Access supaya bisa pakai file external ( cth File .CSS )
    $pdf->setOption('enable-local-file-access', true);
    // Stream untuk menampilkan tampilan PDF pada browser
    return $pdf->stream('testing.pdf');
});


Route::get('/testing/view/pdf', function() {
    $qrcode = QrCode::size(125)->generate('ItSolutionStuff.com');
    return view('testing.testing_pdf', compact('qrcode'));
});

Route::get('/testing/view/kartu', function() {
    $qrcode = QrCode::size(125)->generate('ItSolutionStuff.com');
    return view('testing.testing_kartu', compact('qrcode'));
});

Route::get('/testing/print', 'JemaatController@testingPrint')->name('testing_print');

Route::get('/testing/session', 'UserController@getSession')->name('testing_session');


