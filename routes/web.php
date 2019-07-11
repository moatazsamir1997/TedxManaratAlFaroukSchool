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
    return view('pages.about');
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/signUp', function () {
    return view('auth.register');
});

Route::get('/events', 'EventController@index');

Route::get('/addNewProduct', function () {
    $x=new ProductTypeController();
    $x->getAllTypes();
    return view('pages.addproduct');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


