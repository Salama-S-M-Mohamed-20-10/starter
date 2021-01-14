<?php

use Illuminate\Support\Facades\Route; // For No Showing error in route
use Illuminate\Support\Facades\Auth;  // For No Showing error in auth
//use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
//use LaravelLocalization;
//use LaravelLocalization;
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

Route::get('/dashboard', function () {
    return 'dashboard';
});

Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');

Route::get('fillable', 'CrudController@getOffers');

Route::group(['prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function () {
        Route::group(['prefix' => 'offers'], function () {
            //Route::get('store', 'CrudController@store');
            Route::get('create', 'CrudController@create');
            Route::get('all', 'CrudController@getAllOffers')->name('offers.all');
            Route::post('store', 'CrudController@store') -> name('offers.store');
        });
});



