<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HistoryController@index');

Route::post('/store-text', 'App\Http\Controllers\HistoryController@storeText');

Route::post('/check-text', 'App\Http\Controllers\HistoryController@checkText');