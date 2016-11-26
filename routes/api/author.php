
<?php

Route::get('author/{id}', 'AuthorController@show')->name('author.show');

Route::get('author', 'AuthorController@index')->name('author.index');