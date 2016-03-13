<?php

Route::get('/', [
    'as'   => 'welcome-index',
    'uses' => 'Basic\WelcomeController@index'
]);