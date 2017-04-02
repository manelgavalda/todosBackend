<?php

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'can:show,ManelGavalda\TodosBackend\Task'], function () {
        Route::get('/tasks', function () {
            $token = "TODO";
            $data = [
                "access_token" => $token
            ];
            return view('tasks',$data);
        });
    });

    Route::get('/profile/tokens', function () {
        return view('tokens');
    });

    //adminlte_routes
    Route::get('messages', 'MessagesController@index')->name('messages');

    Route::post('messages', 'MessagesController@sendMessage');

    Route::get('user/messages', 'MessagesController@fetchMessages');

    Route::get('bootstraplayout', 'BootstraplayoutController@index')->name('bootstraplayout');

    Route::get('flexboxlayout2', 'Flexboxlayout2Controller@index')->name('flexboxlayout2');

    Route::get('flexboxlayout', 'FlexboxlayoutController@index')->name('flexboxlayout');

    Route::get('csstables', 'CsstablesController@index')->name('csstables');

    Route::get('layoutfloat', 'LayoutfloatController@index')->name('layoutfloat');

    Route::get('boxmodel', 'BoxmodelController@index')->name('boxmodel');

    Route::get('/float', function () {
        return view('float');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/phpinfo', function () {
    phpinfo();
});
