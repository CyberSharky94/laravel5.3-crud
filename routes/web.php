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

Route::get('/home', 'HomeController@index');
// Route::match(['get', 'post'], 'projects/testform', 'ProjectController@testform')->name('projects.testform');
Route::resource('projects', 'ProjectController');
Route::post('projects/index', 'ProjectController@index')->name('projects.index');
