<?php

Route::group(['namespace' => 'Api'], function() {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('genders', GenderController::class);
});
