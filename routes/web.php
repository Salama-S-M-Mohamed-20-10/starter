<?php

use Illuminate\Support\Facades\Route; // For No Showing error in route
use Illuminate\Support\Facades\Auth;  // For No Showing error in auth
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


Auth::routes(['verify'=>true]); // this is specialize for login and register and reset password and verify password and so on

Route::get('/home', 'HomeController@index')->name('home') ->middleware('verified');

Route::get('/', function () {
     return 'Home';
});