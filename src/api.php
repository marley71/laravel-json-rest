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

});
