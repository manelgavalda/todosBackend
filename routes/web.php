<?php

Gate::define('impossible-gate',function () {
    return false; //No autoritzat.
});

Gate::define('easy-gate',function () {
    return false; //No autoritzat.
});

Gate::define('update-task', function ($user, $task) {
    return $user->id == $task->user_id;
});

Gate::define('update-task1', function ($user) {
    return $user->isAdmin();
});

Gate::define('update-task2', function ($user, $task) {
    if ($user->isAdmin()) return true;
    return $user->id == $task->user_id;
});

Gate::define('update-task3', function ($user, $task) {
    if ($user->isAdmin()) return true;
    if ($user->hasRole('editor')) return true;
    return $user->id == $task->user_id;
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/tasks', function () {
        return view('tasks');
    });

    Route::get('/profile', function () {
        return view('tokens');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo', function () {
    phpinfo();
});
