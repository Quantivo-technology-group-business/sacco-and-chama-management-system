<?php

namespace Modules\Chama\Routes;

use Illuminate\Support\Facades\Route;

Route::prefix('chama')->group(function() {
    Route::prefix('group')->group(function() {
        Route::get('/', 'ChamaController@index');
        Route::get('get_groups', 'ChamaController@get_groups');
        Route::get('create', 'ChamaController@create');
        Route::post('store', 'ChamaController@store');
        Route::get('{id}/show', 'ChamaController@show');
        Route::get('{id}/edit', 'ChamaController@edit');
        Route::post('{id}/update', 'ChamaController@update');
        Route::get('{id}/destroy', 'ChamaController@destroy');

        Route::post('{id}/add_member', 'ChamaController@add_member');
        Route::post('{id}/store_contribution', 'ChamaController@store_contribution');
        Route::post('{id}/store_payout', 'ChamaController@store_payout');
    });
});

Route::prefix('portal/chama')->group(function() {
    Route::get('/', 'MemberChamaController@index');
    Route::get('{id}/show', 'MemberChamaController@show');
});
