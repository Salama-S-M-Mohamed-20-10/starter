<?php
use Illuminate\Support\Facades\Route; // For No Showing error in route
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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/test1', function () {
    return ' Welcome';
});

// route parameterss

Route::get('/show-number/{id}', function ($id) {
    return $id;
})->name("a");*/

Route::get('/admin', function () {
    return 'Hello Admin';
});

// route name


