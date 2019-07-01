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

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/', 'maincontroller@index');
Route::get('/citylocator', 'maincontroller@citylocator');
Route::post('/monthlyEvaluation', 'maincontroller@monthlyEvaluation');
Route::post('/overall', 'maincontroller@overall');
Route::post('/suggestcity', 'maincontroller@suggestcity');
Route::get('/suggession/{city}&{latitude}&{longitude}', 'maincontroller@getcity');


