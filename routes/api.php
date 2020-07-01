<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/search/city/{city}', 'ApiController@showCity');
Route::get('/weather/{lat}/{long}', 'ApiController@showWeather');