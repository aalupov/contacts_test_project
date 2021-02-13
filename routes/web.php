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

//Route::get('/', function () {
 //   return view('welcome');
//});

Route::get('/', array('before' => 'auth', 'uses' => 'HomeController@index'));

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/addContact/{id}', 'HomeController@add')->name('addContact');
Route::delete('/removeContact/{id}', 'HomeController@destroy')->name('removeContact');
Route::get('/userContacts', 'HomeController@user_contacts')->name('userContacts');
