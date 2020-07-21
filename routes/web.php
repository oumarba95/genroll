<?php

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
    return view('welcome');
});
Route::group(['middleware'=>['auth']],function(){
    //refere routes
    Route::get('/referes/rech','RefereController@rech');
    Route::resource('referes','RefereController');
   
    //civile routes
    Route::get('/civiles/rech','CivileController@rech');
    Route::resource('civiles','CivileController');

    Route::get('/audience','ProcedureController@audience');
   //role general routes
   Route::get('/role/general/refere/{id}','RoleGeneralController@createRefere')->name('role.create.refere');
   Route::put('/role/general/refere/{id}','RoleGeneralController@storeRefere')->name('role.store.refere');
   Route::get('/role/general/civile/{id}','RoleGeneralController@createCivile')->name('role.create.civile');
   Route::put('/role/general/civile/{id}','RoleGeneralController@storeCivile')->name('role.store.civile');
});
   //refere routes


//auth routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
