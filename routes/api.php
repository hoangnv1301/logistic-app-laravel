<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api'
], function () {
    Route::post('/login', 'LoginController@login')->name('api.login');
    Route::group([
        'middleware' => ['auth:sanctum']
    ], function () {
        Route::group([
            'prefix' => 'product'
        ], function () {
            Route::get('/', 'ProductController@get')->name('api.product.get');
            Route::get('/{id}', 'ProductController@detail')->name('api.product.detail');
            Route::post('/store', 'ProductController@store')->name('api.product.store');
            Route::patch('/update/{id}', 'ProductController@update')->name('api.product.update');
            Route::delete('/delete/{id}', 'ProductController@delete')->name('api.product.delete');
        });

        Route::group([
            'prefix' => 'supplier'
        ], function () {
            Route::get('/', 'SupplierController@get')->name('api.supplier.get');
            Route::get('/{id}', 'SupplierController@detail')->name('api.supplier.detail');
            Route::post('/store', 'SupplierController@store')->name('api.supplier.store');
            Route::patch('/update/{id}', 'SupplierController@update')->name('api.supplier.update');
            Route::delete('/delete/{id}', 'SupplierController@delete')->name('api.supplier.delete');
        });

        Route::group([
            'prefix' => 'warehouse'
        ], function () {
            Route::get('/', 'WarehouseController@get')->name('api.warehouse.get');
            Route::get('/{id}', 'WarehouseController@detail')->name('api.warehouse.detail');
            Route::post('/store', 'WarehouseController@store')->name('api.warehouse.store');
            Route::patch('/update/{id}', 'WarehouseController@update')->name('api.warehouse.update');
            Route::delete('/delete/{id}', 'WarehouseController@delete')->name('api.warehouse.delete');
        });
    });
});


