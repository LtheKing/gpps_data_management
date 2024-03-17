<?php

use App\Exports\IbadaAttendanceExport;
use App\Models\Jemaat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');

Route::middleware('usersession')->group(function () {
    //jemaat
    Artisan::call('cache:clear');
    Route::get('/jemaat/index', 'JemaatController@index')->name('jemaat_index');
    Route::get('/jemaat/create', 'JemaatController@create')->name('jemaat_create');
    Route::post('/jemaat/store', 'JemaatController@store')->name('jemaat_store');
    Route::get('/jemaat/edit/{id}', 'JemaatController@edit')->name('jemaat_edit');
    Route::get('/jemaat/detail/{id}', 'JemaatController@show')->name('jemaat_detail');
    Route::put('/jemaat/update/{id}', 'JemaatController@update')->name('jemaat_update');
    Route::delete('/jemaat/delete/{id}', 'JemaatController@destroy')->name('jemaat_destroy');
    Route::post('/jemaat/export', 'JemaatController@export')->name('jemaat_export');
    Route::get('/jemaat/absensi', 'JemaatController@absensi')->name('jemaat_absensi');
    Route::post('/jemaat/absensi/export', 'JemaatController@absensiExport')->name('jemaat_absensi_export');
});

//tamu
Route::get('/jemaat/tamu', 'JemaatController@tamuPage')->name('jemaat_tamu');
Route::get('/jemaat/tamu/edit/{id}', 'JemaatController@tamuEdit')->name('jemaat_tamu_edit');
Route::get('/jemaat/tamu/detail/{id}', 'JemaatController@tamuDetail')->name('jemaat_tamu_detail');
Route::put('/jemaat/tamu/update/{id}', 'JemaatController@tamuUpdate')->name('jemaat_tamu_update');
Route::get('/absen/tamu/qr', 'JemaatController@qrTamu')->name('jemaat_tamu_qr');

//api
Route::get('/jemaat/absen/{id}', 'JemaatController@absen_qr')->name('jemaat_absen');
Route::get('/api/token', function () {
    return csrf_token();
});
Route::get('/jemaat/array', 'JemaatController@getJemaatArray')->name('jemaat_array');
Route::delete('/api/jemaat/delete/{id}', 'JemaatController@api_delete')->name('jemaat_api_delete');
Route::get('/api/jemaat/ayah/{nama}', 'JemaatController@getAyah')->name('jemaat_get_ayah');
Route::get('/api/jemaat/ibu/{nama}', 'JemaatController@getIbu')->name('jemaat_get_ibu');
Route::get('/api/jemaat/filter/{field}/{value}', 'JemaatController@filter')->name('jemaat_filter');
Route::get('/api/jemaat/suami/{nama}', 'JemaatController@getSuami')->name('jemaat_get_suami');
Route::get('/api/jemaat/istri/{nama}', 'JemaatController@getIstri')->name('jemaat_get_istri');
Route::post('/api/jemaat/absensi/filter', 'JemaatController@absensiFilter')->name('jemaat_absensi_filter');
Route::get('/jemaat/tamu/array', 'JemaatController@getTamu')->name('jemaat_get_tamu');
Route::delete('/api/jemaat/tamu/delete/{id}', 'JemaatController@api_tamu_delete')->name('tamu_api_delete');
//testing
Route::get('testing/playground', function () {
    return view('testing.playground');
});

Route::get('testing/qrcode', function () {

    QrCode::size(500)
        ->format('png')
        ->generate(route('jemaat_detail', 16), Storage::disk('local')->put('public/images/qrcode.png', 'public'));

    return view('testing.qrcode');
});

Route::get('testing/alert', function () {
    return redirect('/testing/playground')->with('status', 'this is alert');
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/testing/pdf', function () {
    $qrcode = QrCode::size(125)->generate('ItSolutionStuff.com');

    // $pdf = PDF::loadView('testing.testing_pdf', compact('qrcode'));
    $pdf = PDF::loadView('testing.qrcode');

    //Aktifkan Local File Access supaya bisa pakai file external ( cth File .CSS )
    $pdf->setOption('enable-local-file-access', true);
    // Stream untuk menampilkan tampilan PDF pada browser
    return $pdf->stream('testing.pdf');
});

Route::get('/testing/view/pdf', function () {
    $qrcode = QrCode::size(125)->generate('ItSolutionStuff.com');
    return view('testing.testing_pdf', compact('qrcode'));
});

Route::get('/testing/view/kartu', function () {
    $qrcode = QrCode::size(125)->generate('ItSolutionStuff.com');
    return view('testing.testing_kartu', compact('qrcode'));
});

Route::get('/testing/print', 'JemaatController@testingPrint')->name('testing_print');
Route::get('/testing/session', 'UserController@getSession')->name('testing_session');
Route::get('/testing/chart', 'YonatanController@testChart')->name('testing_chart');
Route::get('/testing/getIbadah', function () {
    // 06.00, 07.45, 16.00
    $ibadah1 = strtotime('06:00:00');
    $ibadah2 = strtotime('07:45:00');
    $ibadah3 = strtotime('16:00:00');
    $now = date('H:i:s');

    $result = '';

    if ($now > $ibadah1 && $now < $ibadah2) {
        $result = 'ibadah 1';
    } else if ($now > $ibadah2 && $now < $ibadah3) {
        $result = 'ibadah 2';
    } else {
        $result = 'ibadah 3';
    }

    return $result;
});
Route::get('/testing/jemaat', function () {
    $jemaat = Jemaat::all();
    return $jemaat;
});
Route::get('/testing/multiplesheet', function () {
    return Excel::download(new IbadaAttendanceExport(), 'multiplesheettesting.csv');
})->name('testing_print');
