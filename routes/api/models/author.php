<?php

Route::group(['middleware' => 'auth:api'], function() {

    Route::get('author/{id}', 'AuthorController@show')->name('author.show');

    Route::get('author', 'AuthorController@index')->name('author.index');

    Route::post('author', 'AuthorController@save')->name('author.save');

    Route::put('author/{id}', 'AuthorController@update')->name('author.update');

    Route::delete('author/{id}', 'AuthorController@delete')->name('author.delete');
});