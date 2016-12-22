<?php

Route::get('/user', function (\Illuminate\Http\Request $request) {

    return $request->user();

})->middleware('auth:api');