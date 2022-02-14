<?php

Route::group(['namespace' => 'Api'], function() {
    Route::apiResource('categories', CategoryController::class);
});
