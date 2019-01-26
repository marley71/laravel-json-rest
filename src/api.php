<?php
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 23/01/2019
 * Time: 16:04
 */


Route::group(['as' => 'json'], function () {
    Route::get('json/index', 'JsonController@getIndex');
    Route::get('json/{model}', 'JsonController@getList');

    Route::get('json/{model}/new', 'JsonController@getNew');
    Route::get('json/{model}/{id}', 'JsonController@getShow');

    Route::post('json/{model}','JsonController@postCreate');
    Route::get('json/{model}/{id}/edit','JsonController@getEdit');

    Route::post('json/{model}/{id}','JsonController@postUpdate');
    Route::delete('json/{model}/{id}','JsonController@delete');

    Route::post('json/{model}/delete','JsonController@postDelete');

});
