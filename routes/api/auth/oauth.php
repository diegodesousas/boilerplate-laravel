<?php

Route::post('oauth/token', 'AuthController@issueToken')->name('auth.issue_token');