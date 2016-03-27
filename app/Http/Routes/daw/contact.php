<?php
Route::group(['namespace' => 'Daw\Contact', 'middleware' => 'auth'], function () {
    Route::get('daw-contact', 'ContactController@index')
        ->name('daw.contact.index');

});