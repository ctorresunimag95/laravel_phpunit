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

Route::prefix('api/users')->group(function () {
    Route::get('testServiceProvider/{emailServiceProvider}', 'UserController@TestServiceProvider');
    Route::get('userById/{userId}', 'UserController@GetUserById');
    Route::post('create', 'UserController@CreateUser');
    Route::put('update', 'UserController@UpdateUser');
    Route::get('usersWithBooks', 'UserController@GetUsersWithBook');
    Route::get('', 'UserController@GetAllUsers');
});
