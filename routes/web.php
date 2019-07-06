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
Route::post('/test', 'maincontroller@test');
Route::get('/vinnybookshelf', 'maincontroller@vinnybookshelf');
Route::get('/login', 'maincontroller@login');
Route::get('/registerpage', 'maincontroller@registerpage');
Route::get('/error', 'maincontroller@error');
Route::post('/checklogin', 'maincontroller@checklogin');
Route::get('/vinnybookshelf/admin', 'maincontroller@admin');
Route::post('/uploadBook', 'maincontroller@uploadBook');
Route::post('/viewBook', 'maincontroller@viewBook');
Route::get('/VinnyBookShelf/viewbook/{bookname}','maincontroller@viewdetails');
Route::post('/getDetails','maincontroller@getDetails');
Route::get('/vinnybookshelf/admin/editbook/{bookname}','maincontroller@editdetails');
Route::post('/updateBook','maincontroller@updatebook');
Route::post('/deleteBook','maincontroller@deleteBook');
Route::post('/register', 'maincontroller@register');

