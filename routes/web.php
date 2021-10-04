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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clients','ClientsController@index')->name('clients');
Route::get('/clients/index','ClientsController@index')->name('clients');
Route::post('/clients/create','ClientsController@create');
Route::post('/clients/delete','ClientsController@delete');
Route::get('/clients/id/{id}', 'ClientsController@getClientById');
