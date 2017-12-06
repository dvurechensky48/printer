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


Route::get('/simulation','FillController@lister');

Route::any('/all', 'AllController@lister');
Route::any('/all1', 'AllController@lister1');

//api
Route::any('/info','FillController@info');


//new step
Route::any('/step1','StepController@step1');
Route::any('/step2','StepController@step2');
Route::any('/step3','StepController@step3');

//new interface
Route::any('/','MainController@continent');
Route::any('/{continent}','MainController@country');
Route::any('/country/{country}','MainController@index');

Route::any('/country/{country}/printer','PrinterController@index');
Route::any('/country/{country}/printer/info','PrinterController@info');

Route::any('/country/{country}/user','UserController@index');
Route::any('/country/{country}/user/info','UserController@info');

Route::any('/country/{country}/export','ExportController@index');

//end new interface


Route::any('/printer','PrinterController@index');
Route::any('/printer/info','PrinterController@info');