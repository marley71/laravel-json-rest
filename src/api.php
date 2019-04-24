<?php
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 23/01/2019
 * Time: 16:04
 */


Route::group(['as' => 'json'], function () {
    $whereModel = join("|",config('json_rest.models'));
    Route::get('json/index', 'JsonController@getIndex');

    Route::get('json/{model}', 'JsonController@getList')->where([
        'model' => $whereModel
    ]);

    //die ($where);
    Route::get('json/{model}/search', 'JsonController@getSearch')->where([
        'model' => $whereModel
    ]);

    Route::get('json/{model}/new', 'JsonController@getNew')->where([
        'model' => $whereModel
    ]);

    Route::get('json/{model}/{id}', 'JsonController@getShow')->where([
        'model' => $whereModel
    ]);

    Route::post('json/{model}','JsonController@postCreate')->where([
        'model' => $whereModel
    ]);

    Route::get('json/{model}/{id}/edit','JsonController@getEdit')->where([
        'model' => $whereModel
    ]);

    Route::put('json/{model}/{id}','JsonController@postUpdate')->where([
        'model' => $whereModel
    ]);

    Route::delete('json/{model}/{id}','JsonController@delete')->where([
        'model' => $whereModel
    ]);

    Route::post('json/{model}/delete','JsonController@postDelete')->where([
        'model' => $whereModel
    ]);

    Route::post('json/set/{model}/{fielName}/{value}','JsonController@postSet')->where([
        'model' => $whereModel
    ]);

});
