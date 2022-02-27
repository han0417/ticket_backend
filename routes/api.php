<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {


    Route::group(['middleware' => 'throttle:30:1'], function () {
        Route::post('/login', 'AdminStoreAccountController@login');
        Route::post('/logout', 'AdminStoreAccountController@logout');
        Route::post('/accounts', 'AdminStoreAccountController@create');
        //過jwt middleware
        Route::group(['middleware' => ['jwt']], function () {
            Route::post('/tickets', 'TicketController@create');
        });
    });
});
