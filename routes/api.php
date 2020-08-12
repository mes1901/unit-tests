<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Api'
], function () {
    Route::group([
        'prefix' => 'clients'
    ], function () {
        Route::post('/', 'ClientController@store');
        Route::get('/{id}', 'ClientController@show');
        Route::get('/', 'ClientController@index');
        Route::delete('/{id}', 'ClientController@delete');
    });

    Route::group([
        'prefix' => 'projects'
    ], function () {
        Route::post('/', 'ProjectController@store');
        Route::get('/{id}', 'ProjectController@show');
        Route::get('/', 'ProjectController@index');
        Route::put('/{id}', 'ProjectController@update');
        Route::delete('/{id}', 'ProjectController@delete');
    });
});


