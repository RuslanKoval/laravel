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
//    return view('welcome');
//});
//

Route::get('/', "IndexController@index");

Route::get('/employer/show', [
    'middleware' => 'auth',
    'uses' => 'IndexController@show'
])->name('show');

Route::get('/employer/delete/{id}', [
    'middleware' => 'auth',
    'uses' => 'IndexController@delete'
])->name('employer_delete');

Route::get('/employer/update/{id}', [
    'middleware' => 'auth',
    'uses' =>'IndexController@view'
])->name('employer_update');


Route::post('/employer/update/{id}', [
    'middleware' => 'auth',
    'uses' => 'IndexController@update'
])->name('employer_update');

Route::get('/employer/create', [
    'middleware' => 'auth',
    'uses' => 'IndexController@create'
])->name('employer_create');

Route::post('/employer/create', [
    'middleware' => 'auth',
    'uses' => 'IndexController@save'
])->name('employer_create');

Auth::routes();

Route::get('/home', 'HomeController@index');
