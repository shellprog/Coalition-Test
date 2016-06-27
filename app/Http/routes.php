<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'HomeController@getForm');
    Route::post('/form_submit', 'HomeController@postForm');

    Route::get('/product/{id}', 'HomeController@editProduct');
    Route::get('/product/delete/{id}', 'HomeController@deleteProduct');
    Route::post('/product/{id}', 'HomeController@updateProduct');

});
