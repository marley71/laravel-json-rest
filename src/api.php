<?php
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 23/01/2019
 * Time: 16:04
 */


Route::group(['as' => 'json'], function () {
    Route::get('/api/json/index', 'JsonController@getIndex');
    Route::get('/api/json/{model}', 'JsonController@getList');

    Route::get('/api/json/{model}/new', 'JsonController@getNew');
    Route::get('/api/json/{model}/{id}', 'JsonController@getShow');

    Route::post('/api/json/{model}','JsonController@postCreate');

    Route::get('/api/json/{model}/{id}/edit','JsonController@getEdit');

    Route::put('/api/json/{model}/{id}','JsonController@postUpdate');
    Route::delete('/api/json/{model}/{id}','JsonController@delete');

    Route::post('/api/json/{model}/delete','JsonController@postDelete');

});
