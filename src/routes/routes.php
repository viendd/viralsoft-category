<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array)config('backpack.base.web_middleware', 'web'),
        (array)config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'Viralsoft\Category\app\Controllers',
], function () { // custom admin routes

    Route::crud('category', 'CategoryCrudController');
}); // this should be the absolute last line of this file
Route::get('api/category', 'Viralsoft\Category\app\Controllers\Api\CategoryController@index');
