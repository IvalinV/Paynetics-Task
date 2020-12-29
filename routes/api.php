<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return \App\User::first();
});


#Project
Route::get('/project/list', 'Api\ProjectController@index')->name('api.project.list');
Route::post('/project/store', 'Api\ProjectController@store')->name('api.project.store');
Route::post('/project/show', 'Api\ProjectController@show')->name('api.project.show');
Route::post('/project/update/{id}', 'Api\ProjectController@update')->name('api.project.update');;
Route::post('/project/edit', 'Api\ProjectController@edit')->name('api.project.edit');
Route::post('/project/delete/{id}', 'Api\ProjectController@destroy')->name('api.project.destroy');;

#Task
Route::get('/task/list', 'Api\TaskController@index')->name('api.task.list');
Route::post('/task/store', 'Api\TaskController@store')->name('api.task.store');;
Route::get('/task/show', 'Api\TaskController@show')->name('api.task.show');
Route::post('/task/update/{id}', 'Api\TaskController@update')->name('api.task.update');;
Route::post('/task/edit', 'Api\TaskController@edit')->name('api.task.edit');
Route::post('/task/delete/{id}', 'Api\TaskController@destroy')->name('api.task.destroy');