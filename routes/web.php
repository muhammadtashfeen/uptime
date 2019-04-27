<?php


Route::get('/', function () {
    return view('app');
})->where('any', '.*');

Route::get('/test', 'Controller@pingtest');
