<?php
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 23/01/2019
 * Time: 16:04
 */


Route::group(['as' => 'json'], function () {
    Route::get('json/index', 'JsonController@getIndex');
    Route::get('json/{model}', 'JsonController@getList')->where([
        'model' => join(config('json_rest.models'))
    ]);

    Route::get('json/{model}/new', 'JsonController@getNew')->where([
        'model' => join(config('json_rest.models'))
    ]);
    Route::get('json/{model}/{id}', 'JsonController@getShow')->where([
        'model' => join(config('json_rest.models'))
    ]);

    Route::post('json/{model}','JsonController@postCreate')->where([
        'model' => join(config('json_rest.models'))
    ]);

    Route::get('json/{model}/{id}/edit','JsonController@getEdit')->where([
        'model' => join(config('json_rest.models'))
    ]);

    Route::put('json/{model}/{id}','JsonController@postUpdate')->where([
        'model' => join(config('json_rest.models'))
    ]);
    Route::delete('json/{model}/{id}','JsonController@delete')->where([
        'model' => join(config('json_rest.models'))
    ]);

    Route::post('json/{model}/delete','JsonController@postDelete')->where([
        'model' => join(config('json_rest.models'))
    ]);

    Route::post('json/set/{model}/{fielName}/{value}','JsonController@postSet')->where([
        'model' => join(config('json_rest.models'))
    ]);

});
