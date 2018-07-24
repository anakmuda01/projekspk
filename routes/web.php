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

Route::get('/awal', function () {
    return view('awal/awal');
});

Auth::routes();

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::group(['middleware'=> 'auth'], function(){

  Route::resource('pegawai','PegawaiController');

  Route::get('/wp/nilai', 'WpController@nilai');
  Route::get('/wp/seleksi', 'WpController@seleksi');
  Route::post('/wp-nilai', 'WpController@simpan_nilai');
  Route::resource('wp','WpController');

  Route::get('/saw/nilai', 'SawController@nilai');
  Route::get('/saw/seleksi', 'SawController@seleksi');
  Route::post('/saw-nilai', 'SawController@simpan_nilai');
  Route::resource('saw','SawController');

});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', function(){
    return redirect('/');
});
