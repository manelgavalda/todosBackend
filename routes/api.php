<?php

use Illuminate\Http\Request;

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

//Route::get('/user', function (Request $request){
//    return $request->user();
//})->middleware('auth:api');

//Mapejar funcions.
//Route::resource('task','TasksController');

<<<<<<< HEAD
Route::group(['prefix' => 'v1'], function () {
=======
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
>>>>>>> 5208dfe70039a930c3936e6de232bc096c901e67
    Route::resource('task', 'TasksController');
    Route::resource('user', 'UsersController');
    Route::resource('user.task', 'UserTasksController');
    //Route::resource('task.user', 'UsersController');
});
