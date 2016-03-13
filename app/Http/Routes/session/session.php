<?php
    Route::get('/', [
        'as'   => 'frontend.index',
        'uses' => 'Basic\WelcomeController@index'
    ]);
