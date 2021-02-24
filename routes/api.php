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
Route::resource('/users', 'API\UserController')->except(['show', 'update']);

Route::group(['middleware' => 'auth:api'], function() {
    
});

Route::prefix('asets')->namespace('API')->group(function(){
    Route::get('all', 'AsetController@data');
    Route::get('data', 'AsetController@index');
    Route::post('store', 'AsetController@store');
    Route::post('/{id}/edit', 'AsetController@update');
    Route::delete('delete/{id}', 'AsetController@delete');
});

Route::prefix('users')->namespace('API')->group(function(){
    Route::post('store', 'UserController@store');
});

Route::get('user-authenticated/{token}', 'API\UserController@getUserLogin')->name('user.authenticated');