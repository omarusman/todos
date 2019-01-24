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

Route::get('/', ['uses' => 'TodoController@index']);
Route::get('todos', ['uses' => 'TodoController@all']);
Route::post('todos', ['uses' => 'TodoController@store']);
Route::delete('todos/{id}', ['uses' => 'TodoController@destroy']);