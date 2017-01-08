
<?php

Route::group(['middleware' => 'auth:api'], function() {

    Route::get('author/{id}', 'AuthorController@show')->name('author.show');

    Route::get('author', 'AuthorController@index')->name('author.index');
});