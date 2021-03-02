<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'Auth\LoginController@login');

Route::resource('/asets', 'API\AsetController')->except(['show']);
Route::resource('/laporan', 'API\LaporanController')->except(['show']);
Route::resource('/jadwal', 'API\JadwalController')->except(['show']);
Route::resource('/users', 'API\UserController')->except(['show', 'update']);

Route::group(['middleware' => 'auth:api'], function() {
    
});

Route::prefix('asets')->namespace('API')->group(function(){
    Route::get('data', 'AsetController@index');
    Route::get('{divisi}/data', 'AsetController@index_div');
    Route::post('store', 'AsetController@store');
    Route::post('/{id}/edit', 'AsetController@update');
    Route::delete('delete/{id}', 'AsetController@delete');
});

Route::prefix('laporan')->namespace('API')->group(function(){
    Route::get('data', 'LaporanController@index');
    Route::get('{divisi}/data', 'LaporanController@indexDiv');
    Route::post('store', 'LaporanController@store');
    Route::post('/{id}/edit', 'LaporanController@update');
});

Route::prefix('jadwal')->namespace('API')->group(function(){
    // Route admin
    Route::get('data', 'JadwalController@index');
    Route::get('data-past', 'JadwalController@indexPast');

    // Route Divisi
    Route::get('{divisi}/data', 'JadwalController@indexDiv');
    Route::get('{divisi}/data-past', 'JadwalController@indexDivPast');
    Route::get('{divisi}/data-future', 'JadwalController@indexDivFuture');
    
    
    Route::get('{divisi}/check', 'JadwalController@CheckDivisi');
    Route::get('{id}/detail', 'JadwalController@detail');
    Route::post('store', 'JadwalController@store');
    Route::post('/{id}/edit', 'LaporanController@update');
    Route::delete('delete/{id}', 'JadwalController@delete');
});

Route::prefix('scan')->namespace('API')->group(function(){
    Route::get('{id}/data', 'ScanController@detail');
    Route::get('{divisi}/data', 'JadwalController@indexDiv');
    Route::get('{divisi}/check', 'JadwalController@CheckDivisi');
    Route::get('{id}/detail', 'JadwalController@detail');
    Route::post('store', 'ScanController@store');
    Route::post('/{id}/edit', 'LaporanController@update');
    Route::delete('delete/{id}', 'ScanController@delete');
});

Route::prefix('users')->namespace('API')->group(function(){
    Route::post('store', 'UserController@store');
});

Route::get('user-authenticated/{token}', 'API\UserController@getUserLogin')->name('user.authenticated');