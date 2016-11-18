<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('/tasks', function () {

        //abort('500');
        return view('tasks');
    });
});

Route::get('/', function () {
    return view('welcome');
});