<?php

Route::get('/register', function (){
    return view('auth.register');
});

Auth::routes();

Route::get('/', 'HomeController@dashboard');
Route::get('/dashboard', 'HomeController@dashboard');

