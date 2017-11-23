<?php

Route::get('/','HomeController@index');
Route::get('/search', 'HomeController@search');
Route::get('/rooms', 'HomeController@rooms');
Route::get('/room', 'HomeController@room');

Route::get('/request', 'RequestController@index');
Route::post('/request', 'RequestController@store');
